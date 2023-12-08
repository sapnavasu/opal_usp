import { Component, EventEmitter, Input, OnInit, Output, ViewEncapsulation } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { FileModel, FileUploadArgs } from '@app/common/classes/fileCriteria';
import { DriveService } from '@app/services/drive.service';
import { SharedService } from '../shared.service';
import { FormBuilder, FormGroup, Validators, FormControl, RequiredValidator } from '@angular/forms';
import { MatProgressButtonOptions } from 'mat-progress-buttons';
import { ToastrService } from 'ngx-toastr'
import swal from 'sweetalert';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';


@Component({
  selector: 'app-fileupload',
  templateUrl: './fileupload.component.html',
  styleUrls: ['./fileupload.component.scss'],
  encapsulation: ViewEncapsulation.None

})
export class FileuploadComponent implements OnInit {
  public fileuplode:any;
  i18n(key){
    return this.translate.instant(key);
  }
  file: any;
  @Output() fileuploaded: EventEmitter<FileModel[]> = new EventEmitter<FileModel[]>();
  @Output() deletedSelected: EventEmitter<Boolean> = new EventEmitter<Boolean>();
  @Input('key') key: any;
  @Input('hidedelicon') hidedelicon : boolean = false;
  @Input('placeholder') placeholder: any;
  @Input('ifrequired') ifrequired: boolean = false;
  data: any;
  rawFile: any;
  files: any = null;
  twofiles: boolean = false;
  fileeCriteria: { fileMstRef: any; fileName: any; fileNote: any; fileFormat: any; fileSize: any;  fileData: string; link:string;};
  fileUploadedType: string;
  maxCount = 1;
  fileUrl: string;
  ifarabic : boolean = false;
    constructor(
      private remoteService: RemoteService,
      private cookieService: CookieService,
      public toastr: ToastrService,
      private formBuilder: FormBuilder,
      public driveService: DriveService, 
       private snackBar: MatSnackBar, 
       public shared: SharedService,private translate: TranslateService,) {}
     
      languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
      {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
      dir="ltr";  

  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.ifarabic = false;
        this.spinnerButtonOptionsupload.text = "Upload a file";
      }
      else {
        this.ifarabic = true;
        this.spinnerButtonOptionsupload.text = "حمل ملف أو حدد ملف من أوبال درايف";
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.spinnerButtonOptionsupload.text = "Upload a file";
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.ifarabic = false;
          this.spinnerButtonOptionsupload.text = "Upload a file";
        }
        else {
          this.ifarabic = true;
          this.spinnerButtonOptionsupload.text = "حمل ملف أو حدد ملف من أوبال درايف";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.spinnerButtonOptionsupload.text = "Upload a file";
      }
    });
    this.createForm();

  }
  createForm() {
    this.fileuplode = this.formBuilder.group ({
      files:['', Validators.required],
      upload_files: ['', ''],
    });
  }
  uploaddoc()
  {
    if(this.key)
    {
      this.spinnerButtonOptionsupload.active = true;
      this.shared.getfilemst(this.key).subscribe(data => {
        let temp_selectedFiles: FileModel[] = [];  
        if (data.data != undefined) {  
          if (data.data.selected_files != null) {
            temp_selectedFiles = data.data.selected_files;
          }
          this.fileeCriteria = {
            fileMstRef: this.key,
            fileName: data.data.fileName,
            fileNote: data.data.fileNote,
            fileFormat: data.data.fileFormat,
            fileSize: data.data.fileSize,
            fileData: '',
            link:'',
          };
        } 

        let rawfile = this.rawFile;
    let files = this.files;
    
    let fileArgs: FileUploadArgs;
    let rawFileName:string;
    fileArgs = {
      key: this.key
    };

    let fileSizeExceeded = false;
    for (let i = 0; i < rawfile.target.files.length; i++) {
      const name = rawfile.target.files[i].name;
      rawFileName=name;
      const type = rawfile.target.files[i].type;
      const size = rawfile.target.files[i].size;
      const modifiedDate = rawfile.target.files[i].lastModifiedDate;
      if (rawfile.target.files[i].size > 5242880) {
        fileSizeExceeded = true;
      }
    }
    const maxCount = 1;
    const fileFormat =  this.fileeCriteria.fileFormat;
    const bytes = this.fileeCriteria.fileSize;
    let fileSize;
    const fileformatssplit = fileFormat.split(',');
    const multiplefileformats = fileformatssplit.length;
    const fileformatsjoined = fileformatssplit.join(', ');
    let joinVariable = 'is';
    if (multiplefileformats > 1) {
      joinVariable = 'are';
    }

    if (isNaN(parseFloat('' + bytes)) || !isFinite(bytes)) { return '-'; }
    if (bytes <= 0) { return '0'; }
    const units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB'],
      number = Math.floor(Math.log(bytes) / Math.log(1024));
    fileSize = (bytes / Math.pow(1024, Math.floor(number))).toFixed(1) + ' ' + units[number];


    if (fileSizeExceeded) {
      this.toastr.warning(this.i18n('upload.youcanupload') + fileSize,  '',), {
        timeOut: 3000,
        closeButton: false,
      };
      this.spinnerButtonOptionsupload.active = false;
      return false;
    }
    const result = this.driveService.fileuploadTemp(files, fileArgs).subscribe(
      result => {
        
        if (result.errorCode == 'FILESIZEEXCEED') {
          this.files = null;
          this.toastr.warning(this.i18n('upload.youcanupload') + fileSize, '',), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionsupload.active = false;
          return false;
        } else if (result.errorCode == 'FILEFORMATNOTSUPPORTEDSERVER') {
          this.files = null;
          this.toastr.warning(this.i18n('upload.files') + fileformatsjoined + '.', ' ',), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionsupload.active = false;
          return false;
        } else if (result.errorCode == 'FILENAMEALREADYEXIST') {
          this.files = null;
          this.toastr.warning(this.i18n('upload.same') + fileformatsjoined + '.', '',), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionsupload.active = false;
          return false;
        } else if (result.errorCode == 'FILEEXTNOTALLOWED') {
          this.files = null;
          this.toastr.warning(this.i18n('upload.files') + fileformatsjoined + '.', '',), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionsupload.active = false;
          // this.toastr.warning('You can only upload files with ' + fileformatsjoined + '.', 'warning'), {
          //   timeOut: 3000,
          //   closeButton: true,
          // };
          return false;
        } else if (result.errorCode == 'FILECORRUPTED') {
          this.files = null;
          this.toastr.warning(this.i18n('upload.corr'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionsupload.active = false;
          return false;
        } else {
          const selectedFileData: FileModel[] = [];
          if (result.data.fileName != undefined) {
            selectedFileData[0] = {
              fileName: result.data.fileName,
              fileUrl: result.data.fileUrl,
              fileType: result.data.fileType,
              fileSize: result.data.fileSize,
              fileModified: result.data.fileModified,
              filePk: result.data.filePk,
              link:result.data.link
            };
            this.fileuploaded.emit(selectedFileData);
            this.fileuplode.controls['upload_files'].setValue(selectedFileData[0].fileName);
            this.fileUploadedType = selectedFileData[0].fileType ;
            this.fileUrl = selectedFileData[0].link;
            this.spinnerButtonOptionsupload.active = false;
            this.toastr.success(this.i18n('upload.succ'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
          }
          
        }
      });
      });
    }
    

  }
  spinnerButtonOptionsupload: MatProgressButtonOptions = {
    active: false,
    text: 'Upload a file',
    spinnerSize: 25,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button',
    // buttonIcon: {
    //   opalicon: 'opal-upload',
    // }
  };


  uploadFile(files: File[], rawfile) {
    if(files.length != 1)
    {
      this.toastr.warning(this.i18n('upload.max'), '',), {
        timeOut: 2000,
        closeButton: false,
      };
      this.files = null;
    }
    else{
      this.rawFile = rawfile;
      this.files = files;
      this.uploaddoc();
    }
    
  }

  deleteSelected()
  {
    swal({
      title: this.i18n('upload.deledocu'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('upload.no'), this.i18n('upload.yes')],
      className: this.dir =='ltr'?'swalEng':'swalAr',
    }).then((willGoBack) => {
      if (willGoBack) {
        
        this.files = null;
        this.fileuplode.controls['upload_files'].setValue(null);
        this.fileuploaded.emit(null);
        this.toastr.success(this.i18n('upload.docudele'), ' '), {
          timeOut: 3000,
          closeButton: true,
        };
      }
    });
  }
}
