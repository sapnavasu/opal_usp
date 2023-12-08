import { Component, EventEmitter, Input, OnInit, Output, ViewEncapsulation, ɵConsole } from '@angular/core';
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
import { FlexAlignStyleBuilder } from '@angular/flex-layout';


@Component({
  selector: 'app-multifileupload',
  templateUrl: './multifileupload.component.html',
  styleUrls: ['./multifileupload.component.scss'],
  encapsulation: ViewEncapsulation.None

})
export class MultifileuploadComponent implements OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  public fileuplode:any;
  file: any;
  @Output() fileuploaded: EventEmitter<FileModel[]> = new EventEmitter<FileModel[]>();
  @Output() deletedSelected: EventEmitter<Boolean> = new EventEmitter<Boolean>();
  @Input('key') key: any;
  @Input('placeholder') placeholder: any;
  @Input('ifrequired') ifrequired: boolean = false;
  @Input() callbackFn: (files: any) => void; 
  data: any;
  rawFile: any;
  files: any;
  fileeCriteria: { fileMstRef: any; fileName: any; fileNote: any; fileFormat: any; fileSize: any;  fileData: string; };
  fileUploadedType: string;
  maxCount: boolean;
  twofiles: boolean = false;
  spinnerButtonOptionssaveupdate: MatProgressButtonOptions = {
    active: false,
    spinnerSize: 25,
    type:'button',
    text: 'Upload a file',
    raised: false,
    stroked: false,
    buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
  };
  myFiles:any [] = [];
  public images=[];

  sMsg:string = '';
    constructor(
      private remoteService: RemoteService,
      private cookieService: CookieService,
      public toastr: ToastrService,
      private formBuilder: FormBuilder,
      public driveService: DriveService, 
      private snackBar: MatSnackBar,
       public shared: SharedService,public translate: TranslateService,) {}
     
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
        this.spinnerButtonOptionssaveupdate.text = "Upload a file";
      }
      else {
        this.spinnerButtonOptionssaveupdate.text = "حمل ملف أو حدد ملف من أوبال درايف";
      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.spinnerButtonOptionssaveupdate.text = "Upload a file";
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.spinnerButtonOptionssaveupdate.text = "Upload a file";
        }
        else {
          this.spinnerButtonOptionssaveupdate.text = "حمل ملف أو حدد ملف من أوبال درايف";
        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.spinnerButtonOptionssaveupdate.text = "Upload a file";
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
  uploaddoc(e)
  {
    if(this.key)
    {
    this.spinnerButtonOptionssaveupdate.active = true;
     
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
    for (let i = 0; i < this.myFiles.length; i++) {
      rawFileName=name;
      const type = this.myFiles[i].type;
      const size = this.myFiles[i].size;
      const modifiedDate = this.myFiles[i].lastModifiedDate;
      if (this.myFiles[i].size > 5242880) {
        fileSizeExceeded = true;
      }
    }

    // return false;
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
     
      this.toastr.warning(this.i18n('upload.youcanupload') + fileSize, '',), {
        timeOut: 2000,
        closeButton: false,
      };
      this.spinnerButtonOptionssaveupdate.active = false;
      return false;
    }
    const result = this.driveService.fileupload(this.myFiles, fileArgs).subscribe(
    

      result => {
        console.log(result, 'sssss');
        if (result.data.errorCode == 'FILESIZEEXCEED') {
         
          this.toastr.warning(this.i18n('upload.youcanupload') + fileSize, '',), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionssaveupdate.active = false;
          return false;
        } else if (result.data.errorCode == 'FILEFORMATNOTSUPPORTEDSERVER') {
         
          this.toastr.warning(this.i18n('upload.youcanupload') + fileSize, '',), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionssaveupdate.active = false;
          return false;
        } else if (result.data.errorCode == 'FILENAMEALREADYEXIST') {
          // console.log(true)
          this.toastr.warning(this.i18n('upload.same'),'',), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionssaveupdate.active = false;
          return false;
        } else if (result.data.errorCode == 'FILEEXTNOTALLOWED') {
         
          this.toastr.warning(this.i18n('upload.files') + fileformatsjoined + '.',  '',), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionssaveupdate.active = false;
          return false;
        } else if (result.data.errorCode == 'FILECORRUPTED') {
          
          this.toastr.warning(this.i18n('upload.corr'), '',), {
            timeOut: 2000,
            closeButton: false,
          };
          this.spinnerButtonOptionssaveupdate.active = false;
          return false;
        } else {
         
          this.spinnerButtonOptionssaveupdate.active = false;
          const selectedFileData: FileModel[] = [];
        console.log(result.data.data , 'sllsl');
        // for (let i = 0; i < result.data.length; i++) {
          if (result.data.data.fileName != undefined) {
            console.log(result.data.data , 'innnn');
            selectedFileData[0] = {
              fileName: result.data.data.fileName,
              fileUrl: result.data.data.fileUrl,
              fileType: result.data.data.fileType,
              fileSize: result.data.data.fileSize,
              fileModified: result.data.data.fileModified,
              filePk:result.data.data.filePk
            };

            
            this.images.push(result.data.data);
            console.log(this.images ,'images');
            this.fileuploaded.emit(selectedFileData);
            this.fileuplode.controls['upload_files'].setValue(selectedFileData[0].fileName);
            this.fileUploadedType = selectedFileData[0].fileType;
  
            this.spinnerButtonOptionssaveupdate.active = false;
            // if (result.data.length == 1 && result.data.length != 2) {
            //   this.toastr.success('Document Uploaded Successfully.', ''), {
            //     timeOut: 2000,
            //     closeButton: false,
            //   };
            // }
            // if (result.data.length == 2) {
            //   this.toastr.success('Document Uploaded Successfully.', ''), {
            //     timeOut: 2000,
            //     closeButton: false,
            //   };
            //   this.twofiles = true;
            //   console.log(this.twofiles)
            // }
            // else {
            //   this.twofiles = false;
            // }
            
           
          }
      //  }
        this.toastr.success(this.i18n('upload.succ'), ''), {
              timeOut: 2000,
              closeButton: false,
            };
            if (this.images.length >= 2) {
               this.twofiles = true;
            }
            else {
              this.twofiles = false;
            }
        this.callbackFn(this.images.map(file => file.filePk));
        }
      });
      });
    }
  

  }
  spinnerButtonOptionsupload: MatProgressButtonOptions = {
    active: false,
    text: 'Upload',
    spinnerSize: 15,
    raised: false,
    stroked: false,
    // buttonColor: 'primary',
    spinnerColor: 'warn',
    fullWidth: true,
    disabled: false,
    mode: 'indeterminate',
    type: 'button'
  };


  uploadFile(e) {


    this.uploaddoc(e);
    return false;
    this.toastr.success('Document Uploaded Successfully.', 'success'), {
      timeOut: 3000,
      closeButton: true,
    };

  }

  deleteSelected(key , filepk)
  {
  
    swal({
      title:  this.i18n('upload.deledocu'),
      text: '',
      icon: 'warning',
      
      buttons: [this.i18n('upload.no'), this.i18n('upload.yes')],
      className: this.dir =='ltr'?'swalEng':'swalAr',
    }).then((willGoBack) => {
      if (willGoBack) {
        this.driveService.removefile(key, filepk).subscribe(data => {
          
        for (let i = 0; i < this.images.length; i++) {
          if(this.images[i]['filePk'] === filepk){
            this.images.splice(i, 1);
            $("#hidefile"+filepk).hide();
          }
        } 
        this.callbackFn(this.images.map(file => file.filePk));
        });
        this.fileuploaded.emit(null);
        this.toastr.success(this.i18n('upload.docudele'), ''), {
          timeOut: 3000,
          closeButton: true,
        };
        this.twofiles = false;
      }
    });
  }


  


  getFileDetails (e) {
    this.spinnerButtonOptionssaveupdate.active = true;
    this.myFiles = [];
    let fileSizeExceeded = false;
    let allowedExtension = false;
    var serverAllowedExtensions = ['xlsx', 'xls', 'png', 'pdf', 'jpg', 'jpeg', 'doc', 'docx', 'ppt'];
    let filelength = this.images.length + e.target.files.length;
    if (filelength > 2){
      this.toastr.warning(this.i18n('upload.max'), '', {
        timeOut: 2000,
        closeButton: false,
      });
      this.spinnerButtonOptionssaveupdate.active = false;
      return false;
   }
    for (var i = 0; i < e.target.files.length; i++) {
      if ( e.target.files[i].size > 5242880) {
        fileSizeExceeded = true;
      }
      
      
     var  extension = e.target.files[i].name.substring(e.target.files[i].name.lastIndexOf('.') + 1);
     if(serverAllowedExtensions.includes(extension)){
          for (let i = 0; i < this.images.length; i++) {
          if(this.images[i]['fileName'] === e.target.files[i].name){
            this.toastr.warning(this.i18n('upload.same') ,'',), {
              timeOut: 2000,
              closeButton: false,
            };
            this.spinnerButtonOptionssaveupdate.active = false;
          return false;
          }
          }

        this.myFiles.push(e.target.files[i]);
     }else{
      $("#file").val('');
      this.myFiles = [];
      this.toastr.warning(this.i18n('upload.youcan') ), {
        timeOut: 2000,
        closeButton: false,
      };
      this.spinnerButtonOptionssaveupdate.active = false;
      return false;
     }
      
    }
    this.uploadFile(this.myFiles);

  }
}
