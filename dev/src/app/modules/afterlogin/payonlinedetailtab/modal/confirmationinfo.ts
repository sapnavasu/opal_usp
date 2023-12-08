import { Inject, Component, OnInit, ViewEncapsulation } from "@angular/core";
import { MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";
import { AfterloginService } from '../../afterlogin.service';
import { Encrypt } from '@app/common/class/encrypt';
import { Clipboard } from '@angular/cdk/clipboard';
import { MatSnackBar, MatSnackBarConfig } from '@angular/material/snack-bar';
@Component({
    selector: './modal-dialog',
    templateUrl: './modal-dialog.html',
    styleUrls: ['./modal-dialog.scss'],
    encapsulation: ViewEncapsulation.None,
})
export class Confirmationalert implements OnInit {
    public generatecreditcard:boolean = false;
    public searchData: any = false;
    public ottu_urlinfo:any = [];
    public confrmTitle: any;
    public confrmText: any;
    public generateText: any;
    public email: any;
    public ottu_url: any;
    showLoaderModal: boolean = false;
    constructor(private afterloginService: AfterloginService,private snackBar: MatSnackBar,private clipboard: Clipboard, private security: Encrypt, public dialogRef: MatDialogRef<Confirmationalert>,
        @Inject(MAT_DIALOG_DATA) public paymentinfo: any) { }

    ngOnInit() {
        if(this.paymentinfo.card_type==='cc'){
            this.confrmTitle = 'Generate Payment Link';
            this.confrmText = 'Kindly confirm if you would like to generate the payment link.';
            this.generateText = 'Your secure payment link has been generated.';
            if(this.paymentinfo.crediturl){
                this.paymentinfo['regenerate'] = 2;
                this.confrmTitle = 'Regenerate Payment Link';
                this.confrmText = 'Kindly confirm if you would like to regenerate the payment link.';
                this.generateText = 'Your secure payment link has been regenerated.';
            }
        }
        if(this.paymentinfo.card_type==='dc'){
            this.confrmTitle = 'Generate Payment Link';
            this.confrmText = 'Kindly confirm if you would like to generate the payment link.';
            this.generateText = 'Your secure payment link has been generated.';
            if(this.paymentinfo.debiturl){
                this.paymentinfo['regenerate'] = 1;
                this.confrmTitle = 'Regenerate Payment Link';
                this.confrmText = 'Kindly confirm if you would like to regenerate the payment link.';
                this.generateText = 'Your secure payment link has been regenerated.';
            }
        }
    }
    
    onNoClick(): void {
        this.dialogRef.close();
    }
    
    generatecarddata(){
        this.showLoaderModal = true;
        this.searchData = !this.searchData;
        this.afterloginService.getottulink(this.security.encrypt(JSON.stringify(this.paymentinfo))).subscribe(data => {            
            this.showLoaderModal = false;
            this.ottu_urlinfo = data['data'];  
            this.email = data['data'].email;         
            this.ottu_url = data['data'].payurl;         
        });
    }
    onOkClick(): void {
        this.dialogRef.close(this.ottu_urlinfo);
    }
    copyText(ottu_link) {
        this.clipboard.copy(ottu_link);
    }
    openSnackBar() {
        const config = new MatSnackBarConfig();
        config.duration = 1500;
        config.panelClass = ['copyurlsnackbar'],
        config.verticalPosition = 'top';
        this.snackBar.open('Link Copied!', '', config);
    }
}