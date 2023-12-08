import { Component, EventEmitter, Inject, Input, OnInit, Output, ViewEncapsulation } from '@angular/core';
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { MatSnackBar } from '@angular/material/snack-bar';
import { SimpleDialog } from '@app/@shared/simple-dialog/simple-dialog';
import { Util } from '@app/@shared/util';
import { DriveService } from '@app/services/drive.service';
import { ToastrService } from 'ngx-toastr';
import { fileCriteria, FileModel, FileUploadArgs } from '../classes/fileCriteria';
import { FileeCriteria } from '../classes/fileeCriteria';
import { AppLocalStorageServices } from '../localstorage/applocalstorage.services';
import { SlideInOutAnimation } from './animation';
import { Cropdialog } from './cropdialog/crop-dialog';
import { Uploaddialog } from './uploaddialog/upload-dialog';


export interface FolderModel {
  folderName: string;
  folderSize: string;
  folderModified: string;
  folderDisabled: boolean;
}

@Component({
  selector: 'app-drive',
  templateUrl: './drive.component.html',
  encapsulation: ViewEncapsulation.None

})
export class DriveComponent implements OnInit {
  animationState = 'out';
  @Output() selectedFileData = new EventEmitter();
  @Input('fileeCriteria') fileeCriteria: FileeCriteria;
  @Input('alreadySelectedData') alreadySelectedData: [];
  @Input('isLogo') isLogo: boolean;

  constructor(public dialog: MatDialog,  public toastr: ToastrService) { }
  ngOnInit() {

  }

  openModal(fileCriteria: fileCriteria) {
    console.log("fileeCriteria", this.fileeCriteria);
    const dialogRef = this.dialog.open(DriveModal, {
      width: '250px',
      disableClose: true,
      panelClass: 'drivemodaldialog',
      data: {
        criteria: this.fileeCriteria,
        selectedData: this.alreadySelectedData,
        isLogo: this.isLogo
      }
    });
    dialogRef.afterClosed().subscribe(result => {
      this.selectedFileData.emit(result);
    });
  }



}


export interface DialogData {
  basehdrid: any;
  icvplanspend_pk: any;
  criteria: FileeCriteria;
  files: FileModel[];
  folders: FolderModel[];
  selectedData: number[];
  isLogo: boolean;
}


@Component({
  selector: 'drive-modal',
  templateUrl: 'drivemodal.html',
  styleUrls: ['./drive.component.scss'],
  animations: [SlideInOutAnimation]
})
export class DriveModal {
  [x: string]: any;
  animationState = 'out';
  newFolderName: string;
  isDriveGuided = false;
  isHidden: boolean;
  folders: FolderModel[];
  files: FileModel[];
  uploadedToday: number;
  totalDocument: number;
  loggedInType: any;
  uploadCanvasWidth = 100;
  regPk: any;
  currentPath = '';
  breadcrumbList = [];
  breadcrumbListCount: number;
  selectedFile: FileModel[] = [];
  alreadySelectedData: number[];
  // modalCheckedFiles:number;
  isButtonDisabled = true;
  animal: any;
  uploadeplaceholderloader: boolean = false;
  constructor(
    public cropperDialog: MatDialog,
    public commonDialog: MatDialog,
    public dialogRef: MatDialogRef<DriveModal>,
    @Inject(MAT_DIALOG_DATA) public data: DialogData,
    public driveService: DriveService,
    public util: Util,
    public localData: AppLocalStorageServices,
    private snackBar: MatSnackBar,
    public dialogupload: MatDialog,
    public cropDialog: MatDialog,
    public toastr: ToastrService,

  ) {
    this.regPk = this.localData.getInLocal('registerPk');
    this.loggedInType = this.localData.getInLocal('companytype');
    if (localStorage.getItem('isDriveGuided') == 'true') {
      this.isDriveGuided = true;
    }
    // this.formBaseLink();
    this.breadcrumbList.push(['Home', this.currentPath, this.breadcrumbList.length]);
    this.breadcrumbListCount = this.breadcrumbList.length;
    this.fetchDriveData();
    this.alreadySelectedData = data.selectedData;

  }
  // formBaseLink(){
  //    this.currentPath=this.currentPath+this.regPk;
  // }

  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentdrive') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  openDialog(): void {
    let dialogRef = this.dialogupload.open(Uploaddialog, {
      disableClose: true,
    });

    dialogRef.afterClosed().subscribe(result => {

    });
  }
  openCropDialog(file: any,filename:string,ratio:number): void {
    this.uploadeplaceholderloader = true;
    let cropdialogRef = this.cropDialog.open(Cropdialog, {
      disableClose: true,
      panelClass: 'crop_dialog',
      data: {
        fileData: file,
        fileName: filename,
        ratio:ratio
      },
    });
    cropdialogRef.componentInstance.loaderoffChange.subscribe((value: boolean) => {
      this.loaderoff = value;
      this.uploadeplaceholderloader = value;
    });
    cropdialogRef.afterClosed().subscribe(data => {
      let fileArgs: FileUploadArgs;
      fileArgs = {
        key: this.data.criteria.fileMstRef
      };
    //

      const result = this.driveService.cropUploaded(data.data, data.file,fileArgs,data.fileName).subscribe(
        result => {
            const selectedFileData: FileModel[] = [];
            if (result.data.data.fileName != undefined) {
              selectedFileData[0] = {
                fileName: result.data.data.fileName,
                fileUrl: result.data.data.fileUrl,
                fileType: result.data.data.fileType,
                fileSize: result.data.data.fileSize,
                fileModified: result.data.data.fileModified,
                filePk: result.data.data.filePk
              };
            }
            this.dialogRef.close(selectedFileData);
            this.uploadeplaceholderloader = false;

        });
    });
  }

  enableDrive() {
    this.isDriveGuided = true;
    localStorage.setItem('isDriveGuided', 'true');
  }
  fetchDriveData() {
    this.selectedFile = [];
    this.driveService.list(this.currentPath).subscribe(data => {
      // Check if already selected and make it disabled
      if (data.data.files instanceof Array) {
        data.data.files.forEach((element, index) => {
          let alreadyexist = false;
          this.alreadySelectedData.forEach((element) => {
            if (element == data.data.files[index].filePk) {
              alreadyexist = true;
            }
          }
          );
          const listfiletype = data.data.files[index].fileType;
          const allowedtypes = this.data.criteria.fileFormat;
          const splittedTypes = allowedtypes.replace(/\s/g, "").split(',');
          if (!(splittedTypes.indexOf(listfiletype) > -1)) {
            data.data.files[index].isDisabled = true;
            data.data.files[index].tooltip = 'This format is not supported for this selection';
          }
          if (alreadyexist) {
            data.data.files[index].isDisabled = true;
            data.data.files[index].tooltip = 'You\'ve already selected this file';
          }
          if (this.selectedFile instanceof Array) {
            this.selectedFile.forEach(element => {
              if (element.filePk == data.data.files[index].filePk) {
                data.data.files[index].isSelected = true;
              }
            });
          }
        });

      }
      this.files = data.data.files;

      this.folders = data.data.folders;
      this.uploadedToday = data.data.uploadedToday;
      this.totalDocument = data.data.totalDocument;
      if (this.totalDocument > 0) {
        this.uploadCanvasWidth = 30;
      }
    });
  }
  onDirectoryClick(folder) {
    this.currentPath = this.currentPath + '/' + folder.folderName;
    folder.folderDisabled = true;
    this.breadcrumbList.push([folder.folderName, this.currentPath, this.breadcrumbList.length]);
    this.breadcrumbListCount = this.breadcrumbList.length;
    this.fetchDriveData();
  }
  onBreadcrumbClick(path) {
    this.currentPath = path[1];
    this.breadcrumbList.length = path[2] + 1;
    this.breadcrumbListCount = this.breadcrumbList.length;
    this.fetchDriveData();
  }

  onNewFolderClick() {
    const dialogRef = this.commonDialog.open(SimpleDialog, {
      width: '250px',
      data: {
        title: 'New Folder',
        inputName: 'Folder Name',
        noButtonText: 'Cancel',
        submitButtonText: 'Create',
        folderName: this.newFolderName
      }
    });
    dialogRef.afterClosed().subscribe(result => {
      this.driveService.add(this.currentPath + '/' + result).subscribe(data => {
        this.fetchDriveData();
      });
    });
  }
  onNoClick(): void {
    this.dialogRef.close();
  }
  uploadFile(files: File[], rawfile) {
    console.log("rawfile",rawfile);
    let fileArgs: FileUploadArgs;
    let rawFileName:string;
    this.uploadeplaceholderloader = true;
    fileArgs = {
      key: this.data.criteria.fileMstRef
    };
    let fileSizeExceeded = false;
    for (let i = 0; i < rawfile.target.files.length; i++) {
      const name = rawfile.target.files[i].name;
      rawFileName=name;
      const type = rawfile.target.files[i].type;
      const size = rawfile.target.files[i].size;
      const modifiedDate = rawfile.target.files[i].lastModifiedDate;
      if (rawfile.target.files[i].size > this.data.criteria.fileSize) {
        fileSizeExceeded = true;
      }
    }
    const maxCount = this.data.criteria.fileMaxCount;
    const fileFormat = this.data.criteria.fileFormat;
    const bytes = +this.data.criteria.fileSize;
    let fileSize;
    const fileformatssplit = fileFormat.split(',');
    const fileformatssplitval = fileFormat.split(', ');
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
      this.toastr.warning('You can upload a file of max. size ' + fileSize, ''), {
        timeOut: 2000,
        closeButton: false,
      };
      // this.snackBar.open('You can upload a file of max. size ' + fileSize, '', {
      //   duration: 5000,
      //   panelClass: ['error'],
      //   verticalPosition: 'top'
      // });
      this.uploadeplaceholderloader = false;
      return false;
    }

    const ftype = rawFileName.split('.').pop();
    console.log("ftype",ftype);
    console.log("fileformatssplitval",fileformatssplitval);
    if (this.data.criteria.fileIsCrop) {
      if(fileformatssplitval.includes(ftype.toLowerCase()) == false){
        this.toastr.warning('You can only upload files with ' + fileformatsjoined + '.', ''), {
          timeOut: 2000,
          closeButton: false,
        };
        this.uploadeplaceholderloader = false;
        return false;
      }
    }

    if (this.data.criteria.fileIsCrop) {
      this.openCropDialog(rawfile,rawFileName,this.data.criteria.fileCropRatio);
      return false;
    }

      
    const result = this.driveService.fileupload(files, fileArgs).subscribe(
      result => {
        if (result.data.errorCode == 'FILESIZEEXCEED') {
          this.toastr.warning('You can upload a file of max. size ' + fileSize, ''), {
            timeOut: 2000,
            closeButton: false,
          };
          // this.snackBar.open('You can upload a file of max. size ' + fileSize, '', {
          //   duration: 5000,
          //   panelClass: ['error'],
          //   verticalPosition: 'top'
          // });
      this.uploadeplaceholderloader = false;

          return false;
        } else if (result.data.errorCode == 'FILEFORMATNOTSUPPORTEDSERVER') {
          this.toastr.warning('You can only upload files with ' + fileformatsjoined + '.', ''), {
            timeOut: 2000,
            closeButton: false,
          };
          // this.snackBar.open('Unsupported file format, Please contact our support team.', '', {
          //   duration: 5000,
          //   panelClass: ['error'],
          //   verticalPosition: 'top'
          // });
      this.uploadeplaceholderloader = false;

          return false;
        } else if (result.data.errorCode == 'FILENAMEALREADYEXIST') {
          this.toastr.warning('A file with the same name is already uploaded. You may proceed to upload another file, if required.', ''), {
            timeOut: 2000,
            closeButton: false,
          };
          // this.snackBar.open('A file with the same name is already uploaded. You may proceed to upload another file, if required.', '', {
          //   duration: 5000,
          //   panelClass: ['error'],
          //   verticalPosition: 'top'
          // });
          return false;
        } else if (result.data.errorCode == 'FILEEXTNOTALLOWED') {
          this.toastr.warning('You can only upload files with ' + fileformatsjoined + '.', '',), {
            timeOut: 2000,
            closeButton: false,
          };
          // this.snackBar.open('You can only upload files with ' + fileformatsjoined + '.', '', {
          //   duration: 5000,
          //   panelClass: ['error'],
          //   verticalPosition: 'top'
          // });
          this.uploadeplaceholderloader = false;

          return false;
        } else if (result.data.errorCode == 'FILECORRUPTED') {
          this.toastr.warning('The file seems to be corrupted.', '',), {
            timeOut: 2000,
            closeButton: false,
          };
          // this.snackBar.open('The file seems to be corrupted.', '', {
          //   duration: 5000,
          //   panelClass: ['error'],
          //   verticalPosition: 'top'
          // });
      this.uploadeplaceholderloader = false;

          return false;
        } else {
          const selectedFileData: FileModel[] = [];
          if (result.data.data.fileName != undefined) {
            selectedFileData[0] = {
              fileName: result.data.data.fileName,
              fileUrl: result.data.data.fileUrl,
              fileType: result.data.data.fileType,
              fileSize: result.data.data.fileSize,
              fileModified: result.data.data.fileModified,
              filePk: result.data.data.filePk
            };
            
          }
          this.dialogRef.close(selectedFileData);
          this.uploadeplaceholderloader = false;         
        }
        this.uploadeplaceholderloader = false;    

      });

  }

  onFileCheck(event, key, file) {
    let max_count: number = this.data.criteria.fileMaxCount;
    let selectedCount = 0;
    if (this.data.criteria.selectedFiles != null) {
      selectedCount = this.data.criteria.selectedFiles.length;
    }
    selectedCount = selectedCount + this.selectedFile.length;
    if (event.checked) {
      if (this.data.isLogo) {
        if (this.data.criteria.selectedFiles.length > 0) {
          max_count = +max_count + 1;
        }
      }

      if (selectedCount >= max_count) {
        this.toastr.warning('You have uploaded the maximum allowed number of file', '',), {
          timeOut: 2000,
          closeButton: false,
        };
        // this.snackBar.open('You have uploaded the maximum allowed number of file', '', {
        //   duration: 5000,
        //   panelClass: ['error'],
        //   verticalPosition: 'top'
        // });
        file.isSelected = false;
        event._checked = false;
        event.source.checked = false;
        event.preventDefault();
        return false;
      } else {
        this.selectedFile.push(file);
      }
    } else {
      file.isSelected = false;
      const index = this.selectedFile.indexOf(file);
      if (index > -1) {
        this.selectedFile.splice(index, 1);
      }
    }
    if (this.selectedFile.length > 0) {
      this.isButtonDisabled = false;
    } else {
      this.isButtonDisabled = true;
    }
  }
  onSelectFile(event) {
    if (event.target.files && event.target.files[0]) {
      const reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]); // read file as data url
      reader.onload = (event: any) => { // called once readAsDataURL is completed
        // this.url = event.target.result;
      };
    }
  }


  AddingfromDrive(selectedFile) {
    this.dialogRef.close(selectedFile);
    return false;
  }

}

