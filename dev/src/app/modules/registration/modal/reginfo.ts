import { Inject, Component, OnInit } from "@angular/core";
import { MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";

@Component({
    selector: './modal-dialog',
    templateUrl: './modal-dialog.html',
    styleUrls: ['./modal-dialog.scss'],
})
export class ModalDialogReginfo implements OnInit {
    comanypk: number;
    regpk: number;
    regDetails: any;
    allowClick:boolean = true;
    showPassword: boolean = false;
    superadminpwd: string;
    constructor(
        public dialogRef: MatDialogRef<ModalDialogReginfo>,
        @Inject(MAT_DIALOG_DATA) public data: any) { }

    ngOnInit() {
       
    }
    
    onNoClick(): void {
        this.dialogRef.close();
    }
 
}