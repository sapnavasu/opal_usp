import { Component, OnInit, ViewEncapsulation, ViewChild, Output, EventEmitter, Input } from '@angular/core';
import { FormBuilder, FormGroup, FormArray, Validators, FormControl, FormGroupDirective, RequiredValidator, NgModel } from '@angular/forms';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import moment from 'moment';
import swal from 'sweetalert';
import { ApplicationService } from '@app/services/application.service';
import { ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';
import { ToastrService } from 'ngx-toastr';
import { MatCheckbox } from '@angular/material/checkbox';
import { Encrypt } from '@app/common/class/encrypt';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { environment } from '@env/environment';
@Component({
  selector: 'app-scsiteaudittab',
  templateUrl: './scsiteaudittab.component.html',
  styleUrls: ['./scsiteaudittab.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ScsiteaudittabComponent implements OnInit {
  disableButton: boolean = false;
  loaderform: boolean = true;
  saveandnext: boolean = false;

  disableSelection: boolean = false;
  applicationtype: any;
  sublist: any;
  applicationpk: any;
  i18n(key) {
    return this.translate.instant(key);
  }
  drvInputed: DriveInput;
 
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  tempData: string;
  tempDataCategoryTitle: string;
  tempDataQuestion: string;
  @Input() viewapproveaudit:boolean;
  @Input() siteAuditRes: { cattmp_pk: string; title: boolean; schedtmp_fk: string; categorytitle: string; categorytitle_ar: string; ques: { questionmst_pk: string; title: boolean; cattmp_fk: string; question: string; quesdesc: string; question_ar: string; quesdesc_ar: string; questiontype: string;commentbox: boolean; comments: string; fileupload: any; isselected: string; answer: { answerdtls_pk: string; questionmst_fk: string; answer: string; answer_ar: string; isselected: string; }[]; }[]; }[];
  @ViewChild('fileupload1') fileupload1: Filee;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  @Output() selectedTab: EventEmitter<any> = new EventEmitter<any>();
  @Output() deleteTabDetails: EventEmitter<any> = new EventEmitter<any>();
  @Output() deleteQuest: EventEmitter<any> = new EventEmitter<any>();
  @Input() clickDisable: boolean = false;
  ifarabic: boolean = false;
  tempDataQuestion_ar: any;
  tempDataCategoryTitle_ar: any;
  appid: any;
  contact:any = '';
  viewcomments: boolean = false;
  // i18n(key) {
  //   return this.translate.instant(key);
  // }
  public selectAll: boolean = false;
  projectid: string;
  @Input() project_id:any;
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

  constructor(private formBuilder: FormBuilder,
    private translate: TranslateService,private security: Encrypt,
    private remoteService: RemoteService,public toastr: ToastrService,
    private appservice : ApplicationService,private _location:Location,private fb: FormBuilder,
    private cookieService: CookieService,public routeid: ActivatedRoute) { }
    ranges: any = {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  ngOnInit(): void {
    this.projectid = this.security.decrypt(this.project_id);
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.ifarabic = false;
      } else {
        this.ifarabic = true;
      }
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
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
        } else {
          this.ifarabic = true;
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        //this.patientCategory.get('patientCategory').setValue(toSelect);
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });
    if(this.viewapproveaudit){
      this.viewcomments = true;
    }
    this.routeid.queryParams.subscribe(params => {
      this.applicationpk = params['id'];
      // this.viewpage = params['view'];
    });
    this.appservice.ApprovalSiteauditgetgrade(this.applicationpk).subscribe(data => {
      this.contact = data.data.message;
      this.techinfo = data.data.message;
      if(data.data.message){
      this.length_Of_ck = data.data.message.length;
      }
      // this.onChangeeditor(data.data.message);

    });
   this.radioChange();
    this.drvInputed = {
      fileMstPk: 1,
      selectedFilesPk: []
    };
    this.routeid.queryParams.subscribe(params => {
      this.appid = params['id'];
      // this.viewpage = params['view'];
      const view =params['view'];
      if(view){
       
      }
    });
   
    this.appservice.getsitedata(this.appid).subscribe(data => {
      this.applicationtype = data.data.data[0].appdt_apptype;
    }); 
    console.log(this.siteAuditRes , 'disableSelection');
  }
  getDriveInput(id) {
    return { fileMstPk: 1,
      selectedFilesPk: [id]
    }
  }
  fileeSelected(file, fileId) {
    console.log(file);
    
    fileId.selectedFilesPk = file;    
  }
  edittitle (list) {
    this.tempDataCategoryTitle = list.categorytitle;
    this.tempDataCategoryTitle_ar = list.categorytitle_ar;
  }
  editSubtitle(slist) {
    this.tempDataQuestion = slist.question;
    this.tempDataQuestion_ar = slist.question_ar;

    slist.title=true;
  }
  saveTitle(list) {
    list.title=false;
    console.log(list);
  }
  canceltitle (list,lindex) {
    list.title=false;
    list.categorytitle = this.tempDataCategoryTitle;
    list.categorytitle_ar = this.tempDataCategoryTitle_ar;

  }
  cancelSubtitle(sublist) {
    sublist.question = this.tempDataQuestion;
    sublist.question_ar = this.tempDataQuestion_ar;
    sublist.title=false;
  }
  cancelComment(lindex,subindex,lst,sublst) {
    sublst.commentbox = false;
    sublst = this.tempDataQuestion;
  }
  editComment(sublist) {
    this.tempDataQuestion = sublist.question;
    this.tempDataQuestion_ar = sublist.question_ar;
    sublist.commentbox = true
  }
  saveQuestion(sublist) {
    sublist.title=false;
  }
  save(data) {
    this.disableButton = false;
    data.forEach(quest => {
      if(quest['ques'] != null)
      quest['ques'].forEach(ques => {
        if(ques['isselected'] == "") {
          this.disableButton = true;
        }
      });
    });
    data['message'] = this.comments;
   //let lsiteaudit = this.appservice.getLocalSiteAuditList('siteAuditRes');
  //  console.log(lsiteaudit , 'lsite');
  //  console.log(data , 'data');
  //   if(JSON.stringify(data) == JSON.stringify(lsiteaudit) || this.disableButton) {
  //     swal({
  //       title: "You have not responded to all the Site Audit Questionnaire. Please recheck and complete the Questionnaire. ",
  //       text: "",
  //       icon: 'warning',
  //       // buttons: ['ok',true],
  //       dangerMode: true,
  //       className: this.dir =='ltr'?'swalEng':'swalAr',
  //       closeOnClickOutside: false
  //     }).then((willDelete) => {
  //       if (willDelete) {
  //       }
  //     }); 
  //   } else {
    this.appservice.ApprovalSiteauditrassavemsg(this.applicationpk,this.contact).subscribe(data => {
      
    });
      this.clickDisable = true;
      this.selectedTab.emit(data);
    
  //  } 
  }
  cancelSiteAudit(siteaudit) {
   let lsiteaudit = this.appservice.getLocalSiteAuditList('siteAuditRes');
   if(JSON.stringify(this.siteAuditRes) != JSON.stringify(lsiteaudit)) {
    swal({
      title:this.i18n('uploadassess.doyouwantto'),
      text: "",
      icon: 'warning',
      buttons: [this.i18n('uploadassess.no'), this.i18n('uploadassess.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willDelete) => {
      if (willDelete) {
        this.appservice.getstandardcourselist(siteaudit.schedtmp_fk,'9').subscribe((res:any) => {
          console.log(res);    
          if(res['status'] == 200 && res['success']) {
            this.siteAuditRes = res['data']['data'];
          }
        })
        this.goBack()
      }
    }); 
   } else {
       this.goBack()
   }
  
  }
  deleteQuestion(sublist,index,lindex) {
    swal({
      title:this.i18n('Do you want to confirm the deletion of this question?'),
      text: " ",
      icon: 'warning',
      buttons: [this.i18n('uploadassess.no'), this.i18n('uploadassess.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willDelete) => {
      if (willDelete) {
        this.siteAuditRes[lindex]['ques'].splice(index,1);
        this.deleteQuest.emit(sublist);
        this.toastr.success(this.i18n('The Question has been deleted.'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
    });   
  }
  deleteTopic(list,index) {
    swal({
      title:this.i18n('Do you want to confirm the deletion of this Category? '),
      text: this.i18n('Please note that once deleted, the questions and answers cannot be retrieved.'),
      icon: 'warning',
      buttons: [this.i18n('uploadassess.no'), this.i18n('uploadassess.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if (willDelete) {
        this.siteAuditRes.splice(index, 1);
         this.deleteTabDetails.emit(list);
         this.toastr.success(this.i18n('The Category has been deleted.'), ''), {
          timeOut: 2000,
          closeButton: false,
        };
      }
    });   
  }
  radioChange() {
    let passcount = 0;
    let quescount = 0;
    console.log(this.siteAuditRes, 'test')
    let arrDoc= [];
    this.siteAuditRes.forEach(quest => {
      if(quest['ques'] != null)
          quest['ques'].forEach(ques => {
            quescount = quescount + 1;
            if(ques['isselected'] != "") {
              this.disableSelection = false;
            }
            if(ques['isselected'] == "Not Approved") {
              this.editchkbox.checked = false;
              this.editchkbox.disabled = false;
            }
            if(ques['isselected'] == "Approved") {
              passcount = passcount + 1;
            } 
            // if(ques.children any one false && checkbox false)
            arrDoc.push(ques['isselected']);
          });
    });
    this.disableSelection = arrDoc.includes("");
    console.log(this.disableSelection , 'dkdkdk');
    if(quescount== passcount) {
      this.editchkbox.checked = true;
      this.editchkbox.disabled = true;
    }
  }
  goBack() {
    this._location.back(); 
  }
  checkAllFun(value) {
    this.disableSelection = false;
    // return false;
    this.siteAuditRes.forEach(quest => {
          quest['ques'].forEach(ans => {
            if(ans['isselected'] == "Not Approved" || ans['isselected'] == "") {
              ans['isselected'] = "Approved";
            }
            ans['answer'].forEach(data => {
              if (data['answer']== 'Approved') {    
                data['isselected'] = 'true';
               // data['isselectedold'] = 'true';
              }
              if (data['answer']== 'Not Approved') {    
                data['isselected'] = 'false';
               // data['isselectedold'] = 'false';
              }
          });
    });
  });
}
length = '';
  editerfield: boolean = false;
  public Editor = ClassicEditorBuild;
  public edittechinfo = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  public content: string;


  close() {
    this.techinfo = "";
  }
  resinfo() {
    this.contact = ' ';
    this.techinfo = "";
    this.comments = ``;

  }

  onChangeeditor(event) {
    this.length_Of_ck = $(this.contact).text().length;
    console.log(this.length_Of_ck)
  }
  editinfo() {
    this.edittechinfo = !this.edittechinfo;
  }

  messagedone() {
    this.addinfo();
    this.editinfo();

  }
  addinfo() {
    this.techinfo =  $(this.contact).text();
    console.log(this.techinfo)
  }
  submitted() {
    this.resinfo();
  }
  downLoadPdf(){
    // this.disableSubmitButton = true;  
       this.appservice.ApprovalSiteauditras(this.applicationpk).subscribe(data => {
      // this.disableSubmitButton = false;
      if(data.data.url){
        this.saveandnext = true;
         window.open(environment.baseUrl+data.data.url, "_blank");

      }
    });
  }
}
