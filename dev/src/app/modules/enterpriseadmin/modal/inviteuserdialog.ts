import { Inject, Component, OnInit } from "@angular/core";
import { MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";
import { environment } from "../../../../environments/environment";

@Component({
    selector: './modal-dialog',
    templateUrl: './modal-dialog.html',
    styleUrls: ['./modal-dialog.scss'],
})
export class Inviteuserdialog implements OnInit {
    customCollapsedHeight: string = environment.customCollapsedHeight;
    customExpandedHeight: string = environment.customExpandedHeight;
    currentlyOpenedPanel: any;
    constructor(
        public dialogRef: MatDialogRef<Inviteuserdialog>,
        @Inject(MAT_DIALOG_DATA) public data: any) { }

    ngOnInit() {
    }
    setOpened(index: number) {
        this.currentlyOpenedPanel = index;
      }
    
      setClosed(index: number) {
        if (this.currentlyOpenedPanel == index)
          this.currentlyOpenedPanel = -1;
      }
    
    onNoClick(): void {
        this.dialogRef.close();
    }
 
}