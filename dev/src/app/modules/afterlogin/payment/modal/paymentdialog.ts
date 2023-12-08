
import { Inject, Component, OnInit } from "@angular/core";
import { MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";

@Component({
    selector: './modal-dialog',
    templateUrl: './modal-dialog.html',
    styleUrls: ['./modal-dialog.scss'],
})
export class Paymentdialog implements OnInit {
    constructor(
        public dialogRef: MatDialogRef<Paymentdialog>,
        @Inject(MAT_DIALOG_DATA) public data: any) { }

    ngOnInit() {
      
    }
    
    onNoClick(): void {
        this.dialogRef.close();
    }
 
}