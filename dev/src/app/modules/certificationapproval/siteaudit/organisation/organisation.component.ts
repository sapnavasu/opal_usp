import { Component, EventEmitter, Input, OnInit, Output, ViewEncapsulation } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { FormBuilder, FormGroup, FormControl } from '@angular/forms';
import { ApplicationService } from '@app/services/application.service';
import swal from 'sweetalert';
import { ActivatedRoute } from '@angular/router';
import { MatRadioChange } from '@angular/material/radio';
import { MatCheckboxChange } from '@angular/material/checkbox';
import { DriveInput } from '@app/common/classes/driveInput';
import { Encrypt } from '@app/common/class/encrypt';
@Component({
  selector: 'app-organisation',
  templateUrl: './organisation.component.html',
  styleUrls: ['./organisation.component.scss'],
  encapsulation: ViewEncapsulation.None,

})
export class OrganisationComponent implements OnInit {
  displayedColumns = ['total', 'bronze', 'silver', 'gold'];
  // scorecaculate = new MatTableDataSource<calculatescore>(Scores_DATA);
  public siteAuditForm: FormGroup;
  public siteAuditForms: FormGroup;
  commentbox: boolean = false;
  @Input() hideforeditdata: boolean = false;
  @Input() viewcommentsbox: boolean = false;
  @Input() commentsview: boolean = false;
  @Input() currentIteration: any
  @Input() categorygrade:any;
  @Output() maindata = new EventEmitter<any>();
  @Output() choiceData = new EventEmitter<any>();
  @Output() updateSiteData = new EventEmitter<any>();
  @Output() viewdata = new EventEmitter<any>();
  multichoisecount: any; 
  checkboxarray: any;
  question: boolean = true;
  check: boolean = false;
  favoriteSeason: string;
  appid: any;
  checkBoxAns: any = {};
  selectedquesCalc: any = []
  selectedall: any = [];
  editId: string = '';
  drvInputed: DriveInput;
  centreRequiredDocs: any = {};
  deleteicon: boolean = true;
  editcomment: string = '';
  bronzepercentage: number;
  goldpercentage: number;
  silverpercentage: number;
  gradedata: any;
  bronzeper: number;
  silverper: number;
  goldper: number;
  totalper: number;
  categoryname: string;
  viewpage: any;
  validationForm: FormGroup;
  viewPagecomment: boolean = false;
  bronzeperview: number;
  silverperview: number;
  goldperview: number;
  categorynameview: string;
  totalperview: number;
  public questArr: any= [];
  loaderformeducation: boolean = true;
  showquestions: boolean= true;
  tempDataQuestion: any;
  tempDataQuestionDesc: any;
  tempDataComment: any;
  quesview: boolean = true;
  i18n(key) {
    return this.translate.instant(key);
  }
  disableSubmitButton: boolean;
  @Output() next = new EventEmitter<void>();
  constructor(private translate: TranslateService, private formBuilder: FormBuilder,
    private remoteService: RemoteService,
    private cookieService: CookieService, private appservice: ApplicationService, public routeid: ActivatedRoute, public security: Encrypt,) {
    this.fileeSelected1 = this.fileeSelected1.bind(this);
  }
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {
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
  
    this.formvalidated();
    this.routeid.queryParams.subscribe(params => {
      this.appid = params['id'];

    })
    this.drvInputed = {
      fileMstPk: 2,
      selectedFilesPk: []
    };
    this.viewinvoice();
    if (this.viewpage == 3 || this.viewpage == 4 || this.viewpage == 5 ||  this.viewpage == 6) {
      this.commentsview = true;
      this.hideforeditdata = true;
      this.viewdata.emit(this.commentsview);
      
    } else {
      this.commentsview = false;
      this.hideforeditdata = false;
      this.viewdata.emit(this.commentsview);
    }
     this.appservice.questArray.subscribe(({data, categoryid, multiChoiceCount}) => {
      if(data && this.currentIteration === categoryid){
        this.multichoisecount = multiChoiceCount;
        console.log(data , 'questarray');
        this.questArr = data;
        this.getgradeData(data);
      }
    });
    this.appservice.submitForm.subscribe((props)=>{
      if(this.currentIteration === props.categoryId) this.saveQuestions(props)
    })

  }
 
  // ngOnDestroy(){
  //   // prevent memory leak when component destroyed
  //   this.appservice.questArray.unsubscribe();
  //   this.appservice.submitForm.unsubscribe();
  // }

    getgradeData(data) {    this.checkBoxAns = {}
    this.questArr.forEach(qtn => {
      if (qtn[0].asaqm_fileupload) {
        this.centreRequiredDocs[qtn[0].appsiteauditquestionmsttmp_pk] = {
          fileMstPk: 2,
          selectedFilesPk: [Number(qtn[0].asaqm_fileupload)]
        }
      }
      if (qtn[0].asaqm_questiontype == 1) {
        this.formParentRadio(qtn[0].appsiteauditquestionmsttmp_pk)
      }
      if (qtn[0].asaqm_questiontype === '2') {
        const filteredArr = qtn.filter(q => q.asaad_isselected === '1').map(element => `${Number(element.asaad_order) - 1}_${element.appsiteauditanswerdtls_pk}`)
        this.checkBoxAns[qtn[0].appsiteauditquestionmsttmp_pk] = filteredArr;
      }
      this.formParentArrayFormation(qtn[0].appsiteauditquestionmsttmp_pk);
    });
    this.choiceData.emit({choiceData: this.checkBoxAns, triggerCalculate:true});
    // this.calculatescore();

  }

  formParentArrayFormation(pkey) {
    this.siteAuditForm.addControl('editquestion_' + pkey, new FormControl());
    this.siteAuditForm.addControl('editquestiondesc_' + pkey, new FormControl());
    this.siteAuditForm.addControl('editcomment_' + pkey, new FormControl());
    this.siteAuditForm.addControl('file_' + pkey, new FormControl());
    let careerRequiredDocs = [];
    careerRequiredDocs.push({
      fileMstPk: 4,
      selectedFilesPk: []
    });
  }

  formParentRadio(pkey) {
    this.siteAuditForm.addControl('radio_' + pkey, new FormControl('', []));
  }
  formParentArray(pkey) {
    this.siteAuditForm.addControl('checkbox_' + pkey, new FormControl('', []));
    return true;
  }
  formvalidated() {
    this.siteAuditForm = this.formBuilder.group({
      asarct_grademst_fk: [''],
      asarct_gold: [''],
      asarct_silver: [''],
      asarct_bronze: [''],
      asarct_totalques: [''],
      appsiteauditreportcattmp_pk: [''],
    })
  }
  get form() { return this.siteAuditForm.controls; };
  editfun(quespk) {
    this.editId = quespk.appsiteauditquestionmsttmp_pk;
    this.hideforeditdata = false;
    this.tempDataQuestion = quespk.asaqm_question_en;
    this.tempDataQuestionDesc = quespk.asaqm_quesdesc_en;
    quespk.quesview = false;
  }

  commentfun(quespk) {
    if (!this.drvInputed[quespk.appsiteauditquestionmsttmp_pk]) {
      this.drvInputed[quespk.appsiteauditquestionmsttmp_pk] = {};
    }
   // this.editcomment = quespk;
   quespk.commentbox = true;
   this.tempDataComment = quespk.asaqm_comments;
  }

  cancleedit(quespk) {
     quespk.asaqm_question_en = this.tempDataQuestion;
     quespk.asaqm_quesdesc_en = this.tempDataQuestionDesc;
     this.editId = '';
     quespk.quesview = true;
  }
  addbtn(quespk) {
    this.disableSubmitButton = true;
    this.appservice.saveQuestions(this.siteAuditForm.value , this.checkBoxAns).subscribe(data => {
      this.disableSubmitButton = false; 
       swal({
        title: this.i18n('company.updatsucc'),
        text: " ",
        icon: 'success',
        buttons: [false, this.i18n('company.ok')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then(() => {
        this.editId = '';
        quespk.quesview = true;
      });
    });
    return false;
  }

  radioButtonGroupChange(data: MatRadioChange, pkey) {
    this.siteAuditForm.controls['radio_' + pkey].setValue(data.value);
  }
  onCheckboxChange(event: MatCheckboxChange, qkey, pkey, index) {
    this.siteAuditForm.controls['checkbox_' + pkey].setValue(event.source.value);
    const valKey = `${index}_${pkey}`;
    if (this.checkBoxAns[qkey]) {
      if (!this.checkBoxAns[qkey].includes(valKey) && event.checked) {
        this.checkBoxAns[qkey].push(`${index}_${pkey}`)
        this.siteAuditForm.controls['checkbox_' + pkey].setValue(1);
      } else if (this.checkBoxAns[qkey].includes(valKey) && !event.checked) {
        this.checkBoxAns[qkey].splice(this.checkBoxAns[qkey].indexOf(valKey), 1)
        this.siteAuditForm.controls['checkbox_' + pkey].setValue(2);
      }
    } else if (event.checked) {
      this.checkBoxAns[qkey] = [`${index}_${pkey}`];
    }
    this.choiceData.emit({choiceData: this.checkBoxAns, triggerCalculate:false});
  }


  canclequestion(questionpk , index) {
    swal({
      title: this.i18n('organisation.doyouwanttodel'),
      text: " ",
      icon: 'warning',
      buttons: [this.i18n('organisation.no'), this.i18n('organisation.yes')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true; 
        this.appservice.deleteQuestion(questionpk).subscribe(data => {
          this.disableSubmitButton = false; 
          this.questArr.splice(index, 1);
          if(this.checkBoxAns[questionpk]) {
            delete this.checkBoxAns[questionpk];
            this.multichoisecount-=1;
            this.choiceData.emit({choiceData: this.checkBoxAns, triggerCalculate:false});
          }
          swal({
            title: this.i18n('organisation.quasdelsucc'),
            text: " ",
            icon: 'success',
            buttons: [false, this.i18n('company.ok')],
            dangerMode: true,
            className: this.dir =='ltr'?'swalEng':'swalAr',
            closeOnClickOutside: false
          }).then(() => {
          });    
        });
       
      }else{
 
      }
    });
  
  }

  saveQuestions({categoryId, categoryName,
    selectedBronze,
    selectedsilver,
    selectedgold,gradeMst}) {
    // this.calculatescore();
    this.selectedquesCalc = [];
    (Object.keys(this.checkBoxAns) as []).forEach((key, index) => {
      if (this.checkBoxAns[key].length) this.selectedquesCalc.push(key);
    });
    if (this.selectedquesCalc.length < this.multichoisecount) {
      swal({
        title: this.i18n('organisation.plansall'),
        text: " ",
        icon: 'warning',
        buttons: [false, this.i18n('company.ok')],
        dangerMode: true,
        className: this.dir =='ltr'?'swalEng':'swalAr',
        closeOnClickOutside: false
      }).then(() => {
        //resetForm();
      });
      return false;
    }

    
    this.disableSubmitButton = true;
    this.siteAuditForm.controls['asarct_totalques'].setValue(this.multichoisecount);
    this.siteAuditForm.controls['asarct_bronze'].setValue(selectedBronze);
    this.siteAuditForm.controls['asarct_silver'].setValue(selectedsilver);
    this.siteAuditForm.controls['asarct_gold'].setValue(selectedgold);
    this.siteAuditForm.controls['asarct_grademst_fk'].setValue(gradeMst);
    this.siteAuditForm.controls['appsiteauditreportcattmp_pk'].setValue(categoryId);
    this.appservice.saveQuestions(this.siteAuditForm.value, this.checkBoxAns).subscribe(data => {
      this.disableSubmitButton = false;
      this.updateSiteData.emit(categoryId)
      swal({
        title: this.i18n('organisation.savsuc'),
        text: " ",
        icon: 'success',
        buttons: [false, this.i18n('company.ok')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      }).then(() => {
        this.maindata.emit(data);
      });
    });

  }
  // calculatescore() {
  //   this.selectedbronze = 0;
  //   this.selectedsilver = 0;
  //   this.selectedgold = 0;
  //   (Object.keys(this.checkBoxAns) as []).forEach((key, index) => {
  //     let text = this.checkBoxAns[key];
  //     this.selectedall = [];
  //     text.forEach((element) => {
  //       var aray = element.split("_");
  //       this.selectedall.push(aray[0]);
  //     });

  //     if (this.selectedall.includes('2')) {
  //       this.selectedgold += 1;
  //     } else if (this.selectedall.includes('1')) {
  //       this.selectedsilver += 1;
  //     } else if (this.selectedall.includes('0')) {
  //       this.selectedbronze += 1;
  //     }
  //   });
  //   this.appservice.getgrademst().subscribe(data => {
  //     this.gradedata = data.data.data;
  //     this.bronzepercentage = 1;
  //     this.silverpercentage = 1;
  //     this.goldpercentage = 1;
  //     var bronzepercentage = this.gradedata[0]['gm_scoreinpercent'];
  //     var bronzescorefrom = this.gradedata[0]['gm_scorefrom'];
  //     var bronzescoreto = this.gradedata[0]['gm_scoreto'];
  //     var silverpercentage = this.gradedata[1]['gm_scoreinpercent'];
  //     var silverscorefrom = this.gradedata[1]['gm_scorefrom'];
  //     var silverscoreto = this.gradedata[1]['gm_scoreto'];
  //     var goldpercentage = this.gradedata[2]['gm_scoreinpercent'];
  //     var goldscorefrom = this.gradedata[2]['gm_scorefrom'];
  //     var goldscoreto = this.gradedata[2]['gm_scoreto'];
  //     this.bronzeper = Math.floor((this.selectedbronze / this.multichoisecount) * bronzepercentage);
  //     this.silverper = Math.floor((this.selectedsilver / this.multichoisecount) * silverpercentage);
  //     this.goldper = Math.floor((this.selectedgold / this.multichoisecount) * goldpercentage);
  //     this.totalper = (this.bronzeper + this.silverper + this.goldper);
  //     if (this.totalper >= bronzescorefrom && this.totalper <= bronzescoreto) {
  //       this.categorygrade = 1;
  //       this.categoryname = 'Bronze';
  //     }
  //     if (this.totalper >= silverscorefrom && this.totalper <= silverscoreto) {
  //       this.categorygrade = 2;
  //       this.categoryname = 'Silver';
  //     }
  //     if (this.totalper >= goldscorefrom && this.totalper <= goldscoreto) {
  //       this.categorygrade = 3;
  //       this.categoryname = 'Gold';
  //     }
  //   });
  //   this.siteAuditForm.controls['asarct_totalques'].setValue(this.multichoisecount);
  //   this.siteAuditForm.controls['asarct_bronze'].setValue(this.selectedbronze);
  //   this.siteAuditForm.controls['asarct_silver'].setValue(this.selectedsilver);
  //   this.siteAuditForm.controls['asarct_gold'].setValue(this.selectedgold);
  //   this.siteAuditForm.controls['asarct_grademst_fk'].setValue(this.categorygrade);
  //   this.siteAuditForm.controls['appsiteauditreportcattmp_pk'].setValue(this.categoryid);
  // }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;

  }
  fileeSelected1(file, fileId, formctlname) {

    var ctrlname = 'file_' + formctlname;
    this.centreRequiredDocs[formctlname] = fileId;
    this.siteAuditForm.controls[ctrlname].setValue(file[0])
  }

  viewinvoice() {
    this.routeid.queryParams.subscribe(params => {
      this.viewpage = this.security.decrypt(params['view']);
    });
  }

  resetfun(questionpk) {
   //  this.siteAuditForm.controls['editcomment_' + questionpk.appsiteauditquestionmsttmp_pk].setValue(questionpk.asaqm_comments);
    // this.editcomment = '';
    questionpk.commentbox = false;
    questionpk.asaqm_comments = questionpk.dbcomment;
    console.log(questionpk , 'caanlxcp');
    
  }
}
