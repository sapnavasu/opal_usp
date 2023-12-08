import { Component, OnInit,ViewEncapsulation } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { LearnerFeedbackService } from '@app/services/learnerfeedback.service';
import { ActivatedRoute } from '@angular/router';
@Component({
  selector: 'app-learnerfeedbackview',
  templateUrl: './learnerfeedbackview.component.html',
  styleUrls: ['./learnerfeedbackview.component.scss'],
  encapsulation : ViewEncapsulation.None,
})
export class LearnerfeedbackviewComponent implements OnInit {


  data = [
    {
      title:'TRAINING FACILITY',
      ques:[
        {
          question:'Do you feel the site training facility enhances learning ?',
          answer: 1,
          index: 0,
        },
        {
          question:'Do you feel the classroom is comfortable and appropriate for the course ?',
          answer: 1,
          index: 0,
        },
        {
          question:'Do you feel the workshops/practical areas are well equipped and appropriate for the course ?',
          answer: 1,
          index: 0,
        }
      ]
    },
    {
      title:'PROGRESS',
      ques:[
        {
          question:' Was the process of getting your qualification explained to you clearly?',
          answer: 1,
          index: 0,
        },
        {
          question:' Throughout the course have you been set realistic targets?',
          answer: 2,
          index: 0,
        },
        {
          question:' Do you feel you are progressing well in accordance with the training plan?',
          answer: 1,
          index: 0,
        },
        {
          question:' Do you receive a regular review/feedback of your progress throughout the course?',
          answer: 1,
          index: 0,
        }
      ]
    },
    {
      title:' TRAINING',
      ques:[
        {
          question:'Do you feel the trainers are well prep ?',
          answer: 1,
          index: 0,
        },
        {
          question:'Do you feel the trainers are knowledgeable in the subject area ?',
          answer: 1,
          index: 0,
        },
        {
          question:'Do the trainers present information clearly and accurately ?',
          answer: 3,
          index: 0,
        },
        {
          question:'Do the trainers use a range of visual aids to aid learning ?',
          answer: 1,
          index: 0,
        },
        {
          question:'Do the trainers use  real world scenarios from the Industry to aid learning ?',
          answer: 2,
          index: 0,
        },
        {
          question:'Do the trainers regularly invlove/encourage you by asking questions ?',
          answer: 2,
          index: 0,
        },
        {
          question:'Do the trainers are appropriate tests/exercises ?',
          answer: 1,
          index: 0,
        }
      ]
    },
    {
      title:'ASSESSEMENT (if applicable)',
      ques:[
        {
          question:'Was the assessment plan explained to you clearly at the start of the course?',
          answer: 1,
          index: 0,
        },
        {
          question:'Do you feel you have been given enough time to complete your assessments successfully?',
          answer: 2,
          index: 0,
        },
        {
          question:'Do you feel there is a good range of assessment methods used? ',
          answer: 1,
          index: 0,
        },
        {
          question:'Do you feel you are given constructive feedback following an assessment help you improve? ',
          answer: 3,
          index: 0,
        }
      ]
    },
    {
      title:'RIGHTS AND OPINIONS',
      ques:[
        {
          question:'Do you feel that Learning is interesting and constructive?',
          answer: 1,
          index: 0,
        },
        {
          question:'Do you feel that this qualification will give you a good background in your career?',
          answer: 3,
          index: 0,
        },
        {
          question:'Was the appeals process explained to you clearly ate the start of course ? ',
          answer: 2,
          index: 0,
        },
        {
          question:'Does the level of support you have received meet your expectations? ',
          answer: 2,
          index: 0,
        },
        {
          question:'Do you feel you are being fairly treated? ',
          answer: 1,
          index: 0,
        }
      ]
    }
  ]
  id;
  loading = false;
  alldata;
  questions;
  answer;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  constructor(
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
    private learnerfeedback: LearnerFeedbackService,
    private route: ActivatedRoute,
  ) { }


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

    let i = 1;
    this.data.forEach(item=>{
      item.ques.forEach(quess=>{
        quess.index = i++;
      })
    })
    console.log('this.data', this.data)

    this.id = this.route.snapshot.paramMap.get('id');
    this.getfeedbackquestion();
  }

  getfeedbackquestion(){
    this.loading = true;
    this.learnerfeedback.getfeedbackquestionanswer(this.id).subscribe(res=>{
     this.alldata = res.data;
     this.questions = res.data.feedback;
     this.answer = res.data.feedbackans;

     let i = 1;
     this.questions.forEach(item=>{
       item.questions.forEach(quess=>{
         quess.index = i++;
         let val = this.answer.filter(item => item.lfdbkansd_fdbkquestmst_fk == quess.FdbkQuestMst_PK)
         quess.value = val[0].lfdbkansd_agree == 1 ? 1 : val[0].lfdbkansd_disagree == 1 ? 2 : val[0].lfdbkansd_stronglyagree == 1 ? 3 : 0
       })
     })
     this.loading = false;
    })
  }

}
