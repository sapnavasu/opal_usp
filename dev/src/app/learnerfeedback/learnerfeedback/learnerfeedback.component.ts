import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';
import { LearnerFeedbackService } from '@app/services/learnerfeedback.service';
import { ActivatedRoute } from '@angular/router';
import {MatRadioChange} from '@angular/material/radio';
import swal from 'sweetalert';
import { AdminService } from '../../auth/admin.service';
@Component({
  selector: 'app-learnerfeedback',
  templateUrl: './learnerfeedback.component.html',
  styleUrls: ['./learnerfeedback.component.scss'],
  encapsulation : ViewEncapsulation.None,
})
export class LearnerfeedbackComponent implements OnInit {

  comments = '';
  questions = [];
  id;
  alldata;
  formcompleted = false;
  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  errorMsg = ''
  loading = false;
  constructor(
    private learnerfeedback: LearnerFeedbackService,
    private adminservice : AdminService,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
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
    this.id = this.route.snapshot.paramMap.get('id');
    this.getfeedbackquestion();

  }


  getfeedbackquestion(){
    this.errorMsg = '';
    this.loading = true;
    this.adminservice.getlearnerfeedbackquestion(this.id).subscribe(res=>{
      console.log(res);
      if(!res.data.data){
        
        this.alldata = res.data;
        this.questions = this.alldata.feedback;
        let i = 1;
        this.questions.forEach(item=>{
          item.questions.forEach(quess=>{
            quess.index = i++;
            quess.value = 0;
          })
        })   
        this.loading = false;
      console.log('this.data', this.questions)
      }else{
        this.errorMsg = res.data.data
        this.loading = false;
      }

    })
  }

  onradioclick(index, index1, event: MatRadioChange){
    this.questions[index].questions[index1].value = event.value;
  }

  onSubmit(){
    let res;
    this.questions.forEach(item=>{
      let arr = item.questions.filter(item=>item.value == 0)
      if(arr.length > 0 && item.fdbkct_feedbacklist_en !='Assessment'){
        res = true;
      }
      if(arr.length > 0 && item.fdbkct_feedbacklist_en =='Assessment' && this.alldata.isassessment){
        res = true;
      }
    })

    if(res){
      swal({
        title: 'Kindly anwser all the questions',
        text: " ",
        icon: 'warning',
        buttons: [false, "Ok"],
        className: this.dir =='ltr'?'swalEng':'swalAr',
        dangerMode: true,
        closeOnClickOutside: false
      }).then(() => {
      });
    } else{
      let data = {
        "learnerId" : this.id,
        "questions" : this.questions,
        "comments" : this.comments
      }
      console.log('data',data)
      this.adminservice.savefeedbackquestion(data).subscribe(res=>{
        this.formcompleted = true;
      })
    }
    
  }

}
