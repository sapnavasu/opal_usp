import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { FormBuilder, FormGroup, FormArray, Validators, FormControl, FormGroupDirective, RequiredValidator } from '@angular/forms';
import { MatTableDataSource } from '@angular/material/table';

export interface calculatescore {
  position: any;
  total: any;
  bronze: any;
  silver: any;
  gold:any;
 
}
const Scores_DATA: calculatescore[] = [
  { position: 1, total: 'Value', bronze: '2',silver:'2',gold:'6'},
  { position: 1, total: 'Percentage (%)', bronze: '10%',silver:'1%',gold:'60%'},
 

];
@Component({
  selector: 'app-organisationqa',
  templateUrl: './organisationqa.component.html',
  styleUrls: ['./organisationqa.component.scss']
})
export class OrganisationqaComponent implements OnInit {
  displayedColumns = ['total', 'bronze', 'silver', 'gold'];
  scorecaculate = new MatTableDataSource<calculatescore>(Scores_DATA);
  public siteAuditForm: FormGroup;
  @Output() next = new EventEmitter<void>();
  @Input() ansArr: any;
  commentbox: boolean = false;
  commentboxfrt: boolean = false;
  commentboxtwo: boolean = false;
  commentboxes: boolean = false;
  commentboxthree: boolean = false;
  commentboxfour: boolean = false;
  commentboxfive: boolean = false;
  commentboxsix: boolean = false;
  commentboxseven: boolean = false;
  commentboxeight: boolean = false;
  commentboxten: boolean = false;
  commentboxnine: boolean = false;
  commentboxlastone: boolean = false;
  commentboxlasttwo: boolean  = false;
  commentboxlastfour: boolean = false;
  commentboxlastfive: boolean = false;
  commentboxlastsix: boolean = false;
  commentboxlastseven: boolean = false;
  commentboxlasteight: boolean = false;
  commentboxeslast: boolean = false;
  check: boolean = false;
  favoriteSeason: string;
  favoriteSeasonone: string;
  favoriteSeasontwo: string;
  favoriteSeasonthree: string;
  favoriteSeasonfour: string;
  favoriteSeasonfive: string;
  favoriteSeasonsix: string;
  favoriteSeasonseven: string;
  // favoriteSeasoneight: string;
  seasons: string[] = ['Compliant', 'Non-compliant', 'N/A'];
  two: string[] = ['Compliant', 'Non-compliant', 'N/A'];
  three: string[] = ['Compliant', 'Non-compliant', 'N/A'];
  four: string[] = ['Compliant', 'Non-compliant', 'N/A'];
  five: string[] = ['Compliant', 'Non-compliant', 'N/A'];
  six: string[] = ['Compliant', 'Non-compliant', 'N/A'];
  seven: string[] = ['Compliant', 'Non-compliant', 'N/A'];
  eight: string[] = ['Compliant', 'Non-compliant', 'N/A'];
  disableSubmitButton: boolean;

  checkboxList = [
    {
      title: "1",
      titleone: "There is clear management, direction and culture of good health and safety practices",
      titletwo: "(HSE policy visible and displayed around the centre)"
    },
    {
      title: "2",
      titleone: "There is good management and leadership, direction and culture of embedded health and safety practices",
      titletwo: "(Staff awareness is clear, visible safety signs and practices and implemented polices)"
    },
    {
      title: "3",
      titleone: "There is excellent management and leadership, direction and culture of ubiquitous health and safety practices",
      titletwo: "(Imbedded safety culture for maintaining high standards, good safety records for incident handling and reporting of safety issues on site)"
    }
  ];
  checkboxListtwo = [
    {
      title: "1",
      titleone: "Policies and procedures are communicated to all levels of the centre, managed within a quality system and are reviewed",
      // titletwo:"(HSE policy visible and displayed around the centre)"
    },
    {
      title: "2",
      titleone: "Policies and procedures are communicated to all levels of the centre, managed within a quality system and are annually reviewed.",
      // titletwo:"(Staff awareness is clear, visible safety signs and practices and implemented polices)"
    },
    {
      title: "3",
      titleone: "Policies and procedures are communicated to all levels of the centre, managed within a quality system and are reviewed annually with evidence of auditing and tracked changes.",
      // titletwo:"(Imbedded safety culture for maintaining high standards, good safety records for incident handling and reporting of safety issues on site)"
    }
  ]
  checkboxListthree = [
    {
      title: "1",
      titleone: "Policies and procedures are communicated to all levels of the centre, managed within a quality system and are reviewed in accordance with procedure.",
    },
    { title: "2",
      titleone: "Policies and procedures are communicated to all levels of the centre, managed within a quality system and are annually reviewed.",
    },
    { title: "3",
      titleone: "Policies and procedures are communicated to all levels of the centre, managed within a quality system and are reviewed annually with evidence of auditing and tracked changes.",
    }
  ]
  checkboxListfour = [
    {
      title: "1",
      titleone: "Equality and diversity is promoted in a positive way within the centre and practices are embedded into staff.",
      titletwo: "(Equality policy in place and staff aware of practices)"
    },
    { title: "2",
      titleone: "Equality and diversity is promoted in a positive way within the centre and practices are embedded into staff and learners.",
      titletwo: "(Staff and learner awareness of the policy is good, there is clear communication of appeals and equal opportunities for learners)"
    },
    { title: "3",
      titleone: "Equality and diversity is ubiquitous within the centre and practices are embedded into staff.",
      titletwo: "(Equality and Diversity is a clear culture in the centre, in policy and awareness of staff and learners. There is visible displays of equality and diversity around the centre as well as detailed policies)"
    }
  ]
  checkboxListfive = [
    {
      title: "1",
      titleone: "There is clear management, direction and culture of good health and safety practices",
      titletwo: "(HSE policy visible and displayed around the centre)"
    },
    { title: "2",
      titleone: "There is good management and leadership, direction and culture of embedded health and safety practices",
      titletwo: "(Staff awareness is clear, visible safety signs and practices and implemented polices)"
    },
    { title: "3",
      titleone: "There is excellent management and leadership, direction and culture of ubiquitous health and safety practices",
      titletwo: "(Imbedded safety culture for maintaining high standards, good safety records for incident handling and reporting of safety issues on site)"
    }
  ]
  checkboxListsix = [
    {
      title: "1",
      titleone: "There is an environmental sustainability policy in place that all staff and learners are made aware of.",
    },
    { title: "2",
      titleone: "There is an environmental sustainability policy in place that all staff and learners are aware of, with all being encouraged to",
    },
    { title: "3",
      titleone: "There is an environmental sustainability policy in place that all staff and learners understand work to in order to reduce the",
    }
  ]
  checkboxListseven = [
    {
      title: "1",
      titleone: "The centre is managed by sufficient qualified staff who have a good understanding of training needs and learner outcomes.",
      titletwo: "(Criteria: 2 years sector experience, working towards relevant qualification)"
    },
    { title: "2",
      titleone: "The centre is managed by sufficient qualified staff who have a thorough understanding of training needs and learner outcomes.",
      titletwo: "(Criteria: 5 years sector experience, achieved relevant qualification)"
    },
    { title: "3",
      titleone: "The centre is managed by sufficient qualified staff who have an extensive understanding of training needs and learner outcomes.",
      titletwo: "(Criteria: 10 years sector experience, achieved relevant qualification)"
    }
  ]
  checkboxListeight = [
    {
      title: "1",
      titleone: "The centre is managed by sufficient qualified staff who have a good understanding of training needs and learner outcomes.",
      titletwo: "(Criteria: 2 years sector experience, working towards relevant qualification)"
    },
    { title: "2",
      titleone: "The centre is managed by sufficient qualified staff who have a thorough understanding of training needs and learner outcomes.",
      titletwo: "(Criteria: 5 years sector experience, achieved relevant qualification)"
    },
    { title: "3",
      titleone: "The centre is managed by sufficient qualified staff who have an extensive understanding of training needs and learner outcomes.",
      titletwo: "(Criteria: 10 years sector experience, achieved relevant qualification)"
    }
  ]
  checkboxListnine = [
    {
      title: "1",
      titleone: "The centre is managed by sufficient qualified staff who have a good understanding of training needs and learner outcomes.",
      titletwo: "(Criteria: 2 years sector experience, working towards relevant qualification)"
    },
    { title: "2",
      titleone: "There are sufficient competent and qualified teachers or assessors working towards suitably qualified to support the delivery of all qualifications.",
      titletwo: "(Criteria: 5 years sector experience, achieved relevant qualification)"
    },
    { title: "3",
      titleone: "There are sufficient competent and qualified teachers or assessors suitably qualified and experienced to support the delivery of all qualifications.",
      titletwo: "(Criteria: 10 years sector experience, achieved relevant qualification)"
    }
  ]
  checkboxListten = [
    {
        title:"1",
        titleone: "There is clear management, direction and culture of good health and safety practices",
        titletwo:"(HSE policy visible and displayed around the centre)"
    },
    { title: "2",
      titleone: "There is good management and leadership, direction and culture of embedded health and safety practices",
        titletwo:"(Staff awareness is clear, visible safety signs and practices and implemented polices)"
  },
  { title: "3",
    titleone: "There is excellent management and leadership, direction and culture of ubiquitous health and safety practices",
    titletwo:"(Imbedded safety culture for maintaining high standards, good safety records for incident handling and reporting of safety issues on site)"
  }
  ] 
  checkboxListeleven = [
    {
        title:"1",
        titleone: "The centre has a safe and fair recruitment and training policy for technical and non-technical staff.",
    },
    { title: "2",
      titleone: "The centre has a safe, fair and detailed recruitment and training policy for technical and non-technical staff which covers roles at all levels throughout the business.",
  },
  { title: "3",
    titleone: "The centre has a safe, fair and detailed recruitment and training policy for technical and non-technical staff which covers roles at all levels throughout the business and includes opportunity for staff development and promotion.",
  }
  ] 
  checkboxListlastone = [
    {
        title:"1",
        titleone: "Training and development is carried out to address identified needs of technical and non-technical staff.",
        titletwo:"(CPD requirements / selection are not consistent)",
        checked:true,
    },
    { title: "2",
      titleone: "Training and development is carried out to address identified needs of technical and non-technical staff and they are encouraged to identify additional training to improve their assessing and internal verifying capability.",
        titletwo:"(CPD is encouraged and all staff have the opportunity to attend courses)",
        checked:false,
        ReadOnlyStyleGuideNotes:true
    },
  { title: "3",
    titleone: "Training and development is carried out to address identified needs of technical and non-technical staff and they are enabled to maintain their occupational competence by work placement.",
    titletwo:"(There is a CPD plan for the year covering staff at different levels and CPD events are mandatory as part of the job role)",
    checked:false,
    ReadOnlyStyleGuideNotes:true
  }
  ] 
  checkboxListlast = [
    {
        title:"1",
        titleone: "There is a process of communication set up for the reporting of serious assessment malpractice, appeals and complaints (where applicable) to OPAL.",
    },
    { title: "2",
      titleone: "There is a process of communication set up for the reporting of serious assessment malpractice, appeals and complaints (where applicable) to OPAL,  and staff understand it and are encouraged to work to it.",
  },
  { title: "4",
    titleone: "There is a process of communication set up for the reporting of serious assessment malpractice, appeals and complaints (where applicable) to OPAL,and staff and learners understand it and are encouraged to work to it.",
  }
]

  constructor(private translate: TranslateService, private formBuilder: FormBuilder,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }


  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {
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
    this.formvalidated();
  }

  formvalidated() {
    this.siteAuditForm = this.formBuilder.group({
      give_comments: [''],
      first: [''],
      second: [''],
      third: [''],
      fourth: [''],
      fifth: [''],
      sixthone: [''],
      seven: [''],
      eight: [''],
      checkboxone: [''],
      checkboxtwo: [''],
      checkboxthree: [''],
      checkboxfour: [''],
      checkboxfive: [''],
      checkboxsix: [''],
      checkboxeight: [''],
      checkboxnine: [''],
      checkboxten: [''],
      checkboxeleven: [''],
      checkboxlastone: [''],
      checkboxlast: [''],
      frtbox: [''],
      sndbox: [''],
      thrdbox: [''],
      fourthbox: [''],
      fifthbox: [''],
      sixthbox: [''],
      seventhbox: [''],
      eigthbox: [''],
      ninethbox: [''],
      tenthbox: [''],
      frtonebox: [''],
      sndonebox: [''],
      fourthonebox: [''],
      thrdonebox: [''],
      fifthonebox: [''],
      sixthonebox: [''],
      seventhonebox: [''],
      eightthonebox: [''],
      ninethonebox: [''],
     
    })
  }
  
  get form() { return this.siteAuditForm.controls; }

  commentBox (value) {
    if (value == 1) {
      this.commentboxfrt = true;
    }
    else if (value == 2) {
      this.commentboxes = true;
    }
    else if (value == 3) {
      this.commentboxthree = true;
    }
    else if (value == 4) {
      this.commentboxfour = true;
    }
    else if (value == 5) {
      this.commentboxfive = true;
    }
    else if (value == 6) {
      this.commentboxsix = true;
    }

      else if (value == 7) {
      this.commentboxseven = true;
    }
    else if (value == 8) {
      this.commentboxeight = true;
    }
    else if (value == 9) {
      this.commentboxnine = true;
    }
    else if (value == 10) {
      this.commentboxten = true;
    }
    else if (value == 11) {
      this.commentboxlastone = true;
    }

      else if (value == 12) {
      this.commentboxlasttwo = true;
    }
    else if (value == 13) {
      this.commentboxthree = true;
    }
    else if (value == 14) {
      this.commentboxlastfour = true;
    }
    else if (value == 15) {
      this.commentboxlastfive = true;
    }
    else if (value == 16) {
      this.commentboxlastsix = true;
    }
    else if (value == 17) {
      this.commentboxlastseven = true;
    }
    else if (value == 18) {
      this.commentboxlasteight = true;
    }  
    else {
      this.commentboxeslast = true;
    }

  }
  cancle(value)  {
    if (value == 1) {
      this.commentboxfrt = false;
    }
    else if (value == 2) {
      this.commentboxes = false;
    }
    else if (value == 3) {
      this.commentboxthree = false;
    }
    else if (value == 4) {
      this.commentboxfour = false;
    }
    else if (value == 5) {
      this.commentboxfive = false;
    }
    else if (value == 6) {
      this.commentboxsix = false;
    }

      else if (value == 7) {
      this.commentboxseven = false;
    }
    else if (value == 8) {
      this.commentboxeight = false;
    }
    else if (value == 9) {
      this.commentboxnine = false;
    }
    else if (value == 10) {
      this.commentboxten = false;
    }
    else if (value == 11) {
      this.commentboxlastone = false;
    }

      else if (value == 12) {
      this.commentboxlasttwo = false;
    }
    else if (value == 13) {
      this.commentboxthree = false;
    }
    else if (value == 14) {
      this.commentboxlastfour = false;
    }
    else if (value == 15) {
      this.commentboxlastfive = false;
    }
    else if (value == 16) {
      this.commentboxlastsix = false;
    }
    else if (value == 17) {
      this.commentboxlastseven = false;
    }
    else if (value == 18) {
      this.commentboxlasteight = false;
    }  
    else {
      this.commentboxeslast = false;
    }

  }
}
