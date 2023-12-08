import { Inject, Component, OnInit } from "@angular/core";
import { MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";
@Component({
    selector: './upload-dialog',
    templateUrl: './upload-dialog.html',
    styleUrls: ['./upload-dialog.scss'],
})
export class Uploaddialog implements OnInit {
    value = 'Only me';
    searchOptions=[
        {'value':1,'name':'Only me'},
        {'value':2,'name':'Organization'},
        {'value':3,'name':'Public'}
      ];
    constructor(
        public dialogRef: MatDialogRef<Uploaddialog>,
        @Inject(MAT_DIALOG_DATA) public data: any) { }

    ngOnInit() {
       
    }
 
    onNoClick(): void {
        this.dialogRef.close();
    }
  
}