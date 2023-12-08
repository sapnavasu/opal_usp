import { Component, Inject } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';


export interface simpleDialogCriteria{
  title:string;
  inputName:string;
  noButtonText:string;
  submitButtonText:string;
  data:string;
}

@Component({
  selector: 'app-simple-dialog',
  templateUrl: './simple-dialog.html',
  styleUrls: ['./simple-dialog.scss']
})
export class SimpleDialog {
  
  constructor(
    public dialogRef: MatDialogRef<SimpleDialog>,
    @Inject(MAT_DIALOG_DATA) public data:simpleDialogCriteria) {}

  onNoClick(): void {
    this.dialogRef.close();
  }

}
