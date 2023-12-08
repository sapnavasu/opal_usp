import { Component, EventEmitter, OnInit, Output, Input, OnChanges, SimpleChanges, ɵConsole } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ApplicationService } from '@app/services/application.service';
import swal from 'sweetalert';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { Location } from '@angular/common';
import { Encrypt } from '@app/common/class/encrypt';
import { environment } from '@env/environment';
@Component({
  selector: 'app-finalgrade',
  templateUrl: './finalgrade.component.html',
  styleUrls: ['./finalgrade.component.scss']
})
export class FinalgradeComponent implements OnInit  {
  nextlevlbutton: boolean;
  i18n(key) {
    return this.translate.instant(key);
  }
  public bronze = false;
  public gold = false;
  public silver = false;
  @Output() canclebtn = new EventEmitter<void>();
  sitecategory: any[];
  @Input() appdt_gradingreason: any;
  @Input('viewcomments') viewcomments: boolean = false; 
  @Output() appdata = new EventEmitter<any>();
  disableSubmitButton: boolean;
  gradedata: any;
  length = '';
  editerfield: boolean = false;
  public Editor = ClassicEditorBuild;
  public edittechinfo = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  validationForm: FormGroup;
  public content: string;
  refname: any;
  totalpercentage: any;
  totalper: number;
  goldscoreto: any;
  goldscorefrom: any;
  silverscoreto: any;
  silverscorefrom: any;
  bronzescorefrom: any;
  bronzescoreto: any;
  categoryname: string;
  categorygrade: number;
  viewpage: any;
  submitButton: boolean = true;
  constructor(private translate: TranslateService,private _location:Location,
    private remoteService: RemoteService,private fb: FormBuilder,
    private cookieService: CookieService,private appservice : ApplicationService,public routeid: ActivatedRoute , public route: Router, public security: Encrypt,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
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
  setSiteCategory() {
    //  this.siteCategoryInfo = changes.sitecategory.currentValue;


    this.totalpercentage = 0;
    this.nextlevlbutton = true;
    this.sitecategory.forEach(element => {

        this.bronzescorefrom = element.bronzescorefrom;
       this.bronzescoreto = element.bronzescoreto;
       this.silverscorefrom = element.silverscorefrom;
       this.silverscoreto = element.silverscoreto;
       this.goldscorefrom = element.goldscorefrom;
       this.goldscoreto = element.goldscoreto;
       if(isNaN(element.bronzePer) && isNaN(element.goldPer) && isNaN(element.silverPer)){
        this.nextlevlbutton = false;
       }
     
      this.totalpercentage += (element.bronzePer + element.goldPer + element.silverPer);
     
    }); 
    console.log( this.nextlevlbutton , '21');
    this.totalper = Math.round(this.totalpercentage/this.sitecategory.length);


    if (this.totalper >= this.bronzescorefrom && this.totalper <= this.bronzescoreto) {
      this.categorygrade = 1;
      this.categoryname = 'Bronze';
  }
  if (this.totalper >=  this.silverscorefrom && this.totalper <= this.silverscoreto) {
    this.categorygrade = 2;
    this.categoryname = 'Silver';
  }
 if (this.totalper >= this.goldscorefrom && this.totalper <= this.goldscoreto) {
    this.categorygrade = 3;
    this.categoryname = 'Gold';
 
  }
   //console.log(this.totalper ,  'child');
     this.appdata.emit(this.categorygrade);
     console.log(this.totalpercentage/this.sitecategory.length ,'toralpercentage');
  }
 





  ngOnInit(): void {
    // this.siteCategoryInfo = this.sitecategory;
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
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });

    this.validForm()

    this.routeid.queryParams.subscribe(params => {
      this.viewpage = params['id'];
    });


    console.log(this.sitecategory , 'sitecatedory');
    this.appservice.finalTabData.subscribe(data=> {
      this.sitecategory = data;
      this.setSiteCategory()
    })

  }
  onChangeeditor(event) {
    this.length_Of_ck = $(this.validationForm.controls['comments'].value).text().length;
    this.comments = $(this.validationForm.controls['comments'].value).text();
    if (this.length_Of_ck > 5000) {
      this.validationForm.setErrors({ 'invalid': true });
      this.validationForm.controls['comments'].setErrors({ 'incorrect': true });
    }


  }
  close() {
    this.validationForm.reset();
    this.techinfo = "";
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

  closeModalPopup(): void {
    this.resinfo();
    this.validationForm.controls.status.reset()
  }
  messagedone() {
    this.addinfo();
    this.editinfo();

  }
  addinfo() {
    this.techinfo = this.validationForm.controls['comments'].value;
  }
  submitted() {

    this.resinfo();
    this.validationForm.controls.status.reset();

  }

submitnextlevel(){
  this.disableSubmitButton = true; 
   this.appservice.ApprovalSiteaudit(this.validationForm.value , this.viewpage).subscribe(data => {
    this.disableSubmitButton = false;
     if(data.data.msg == 'false'){
        swal({
          title:this.i18n('siteaudit.somewewron'),
          text: " ",
          icon: 'warning',
          buttons: [false, this.i18n('siteaudit.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
         // this.standardTemplate = 'MainCentre';
        })
      }else{
       
        swal({
          title: this.i18n('siteaudit.subforqua'),
          text: " ",
          icon: 'success',
          buttons: [false, this.i18n('siteaudit.ok')],
          dangerMode: true,
          className: this.dir =='ltr'?'swalEng':'swalAr',
          closeOnClickOutside: false
        }).then(() => {
    
          this.route.navigate(['centrecertification/home/MQ==']);
        
        })
      }  
      });
      
   }
   goBack() {
    this._location.back(); 
  }
downLoadPdf(){
    this.disableSubmitButton = true;     this.appservice.ApprovalSiteaudit1(this.validationForm.value , this.viewpage).subscribe(data => {
      this.disableSubmitButton = false;
      if(data.data.url){
         window.open(environment.baseUrl+data.data.url, "_blank");

      }
   
    this.submitButton = false; 
    });
  }
}
