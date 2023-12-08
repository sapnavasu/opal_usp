import { Component, Inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { TrainingStaffService } from '@app/services/trainingStaff.service';
import moment from 'moment';
import { LocaleConfig } from 'ngx-daterangepicker-material';



export interface simpleDialogCriteria{
  title:string;
  inputName:string;
  noButtonText:string;
  submitButtonText:string;
  civil:any;
  staffInfoTemp:any;
  data:string;
  staff: any;
  course: any;
  coursePk: any;
}

@Component({
  selector: 'datepickermodal',
  templateUrl: './datepickermodal.html',
  styleUrls: ['./datepickermodal.scss']
})
export class Datepickermodal {
  
  locale: LocaleConfig = {
    format: 'DD-MM-YYYY',
  }
  dateForm: FormGroup;
  formSubmit:boolean = false;
  date: any= null;
  ranges: any = {
    'Today': [moment(), moment()],
    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
  constructor(
    public dialogRef: MatDialogRef<Datepickermodal>,
    private trainingstaff: TrainingStaffService,
    @Inject(MAT_DIALOG_DATA) public data:simpleDialogCriteria,
    private fb: FormBuilder) {}

    ngOnInit() {
      this.initForm()
    }

    initForm(){
      this.dateForm = this.fb.group({
        date: ["",Validators.required]
      })
    }

  onNoClick(): void {
    this.dialogRef.close();
  }
  download() {
    this.formSubmit = true;
    console.log(this.dateForm);
    console.log(this.dateForm.value.date)
    if(this.dateForm.value.date.startDate != null && this.dateForm.value.date.endDate != null){
    let dateRange = {
      startDate:this.dateForm.value.date.startDate?.format('YYYY-MM-DD'),
      endDate: this.dateForm.value.date.endDate?.format('YYYY-MM-DD')
    }
    this.dialogRef.close({civil: this.data.civil,staffInfoTemp: this.data.staffInfoTemp,dateRange: dateRange,coursePk: this.data.coursePk})
  }
    // this.trainingstaff.exportSingle(this.data.civil, this.data.staffInfoTemp,dateRange,this.data.coursePk).subscribe((data: any) => {
    //   let response = data.data.attend;
    //   var link = document.createElement('a');
    //   link.href = response
    //   link.click();
    // })
  }

}
