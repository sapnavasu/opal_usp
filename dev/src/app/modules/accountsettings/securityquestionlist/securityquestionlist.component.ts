import { Component, Input, OnChanges, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, ValidatorFn } from '@angular/forms';

import { AccountsettingsService } from '../accountsettings.service';
// import { Successdialog } from '../modal/successdialog';
import swal from 'sweetalert';
import {CdkTextareaAutosize} from '@angular/cdk/text-field';
import {NgZone} from '@angular/core';
import {take} from 'rxjs/operators';
import { MatDialog } from '@angular/material/dialog';
import { Successdialog } from '@app/@shared/modal/successdialog';
import {ToastrService} from 'ngx-toastr'
@Component({
  selector: 'app-securityquestionlist',
  templateUrl: './securityquestionlist.component.html',
  styleUrls: ['./securityquestionlist.component.scss']
})

export class SecurityquestionlistComponent implements OnInit,OnChanges {
  public accountsettingForm: FormGroup;
  parentCount = 0;
  @Input() questArr: any
  @Input() alreadyAnswered: any
  @ViewChild('autosize') autosize: CdkTextareaAutosize;
  constructor(private fb: FormBuilder,private dialog: MatDialog,
    private accSettingsService: AccountsettingsService, 
    private _ngZone: NgZone,public toastr: ToastrService ) { }

  ngOnInit() {
    this.accountsettingForm = this.fb.group({
      question1:[null,null],
      question2:[null,null],
      question3:[null,null],
      question4:[null,null],
      answer1:[null,null],
      answer2:[null,null],
      answer3:[null,null],
      answer4:[null,null],
    });
  }

  displayCounter(count){
    this.parentCount = count;
  }

  ngOnChanges() {
    if(this.alreadyAnswered) {
      this.accountsettingForm.patchValue(this.alreadyAnswered);
    }
  }
  triggerResize() {
    this._ngZone.onStable.pipe(take(1))
        .subscribe(() => this.autosize.resizeToFitContent(true));
  }
  customValidator(group: FormGroup): any {
    let questionSelectedCount = 0;
      for(let i = 1; i <= 4; i++){
        if(group.controls["question"+i].value && group.controls["answer"+i].value){
          questionSelectedCount = questionSelectedCount + 1;
        }
      }
      if(questionSelectedCount < 2) {
        group.setErrors({ selecttwo: true });
        return null;
      }
      return true;
  }
  get f(){return this.accountsettingForm.controls;}

  openDialog(): void {
    let dialogRef = this.dialog.open(Successdialog,{
      panelClass: 'custom-modalbox'
    });

    dialogRef.afterClosed().subscribe(result => {
      
    });
  }

  saveAnswers(){
    if(this.customValidator(this.accountsettingForm)){
      this.accSettingsService.saveSecurityQA(this.accountsettingForm.value).subscribe(data => {
        if(data['data'].status == 1){
          this.showSuccess();
          // swal({
          //   title: 'saved successfully.',
          //   icon: 'success',
          //   closeOnClickOutside: false,
          //   closeOnEsc: false
          // })
        }
      })
    }
  }
  showSuccess(){
    this.toastr.success('Deleted Successfully', 'Success !', {
      timeOut: 3000,
      closeButton: true,
    });
}
}
