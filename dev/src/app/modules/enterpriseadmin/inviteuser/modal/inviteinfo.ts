import { Inject, Component, OnInit } from "@angular/core";
import { MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";

@Component({
    selector: './modal-dialog',
    templateUrl: './modal-dialog.html',
    styleUrls: ['./modal-dialog.scss'],
})
export class Inviteinfo implements OnInit {
    activeEmailArrInSameCompany: string[] = [];
    activeEmailArrInAnotherCompany: string[] = [];
    alreadyInvitedAndActiveEmailArrInSameCompany: string[] = [];
    alreadyInvitedAndActiveEmailArrInAnotherCompany: string[] = [];
    inactiveSameCompanyEmails: string[] = [];
    invalidEmails: string[] = [];
    constructor(public dialogRef: MatDialogRef<Inviteinfo>,
        @Inject(MAT_DIALOG_DATA) public data: any) { }

    ngOnInit() {
        this.activeEmailArrInSameCompany = this.data.emailList.activeEmailArrInSameCompany;
        this.activeEmailArrInAnotherCompany = this.data.emailList.activeEmailArrInAnotherCompany;
        this.alreadyInvitedAndActiveEmailArrInSameCompany = this.data.emailList.alreadyInvitedAndActiveEmailArrInSameCompany;
        this.alreadyInvitedAndActiveEmailArrInAnotherCompany = this.data.emailList.alreadyInvitedAndActiveEmailArrInAnotherCompany;
        this.inactiveSameCompanyEmails = this.data.emailList.inactiveSameCompanyEmails;
        this.invalidEmails = this.data.emailList.invalidEmails;
    }
    
    onNoClick(): void {
        this.dialogRef.close();
    }
 
}