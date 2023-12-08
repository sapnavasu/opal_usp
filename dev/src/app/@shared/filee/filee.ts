import { Component, EventEmitter, forwardRef, Input, OnChanges, OnInit, Output, ViewChild } from '@angular/core';
import { ControlValueAccessor, FormControl, NG_VALIDATORS, NG_VALUE_ACCESSOR } from '@angular/forms';
import { MatSnackBar } from '@angular/material/snack-bar';
import { SharedService } from '@app/@shared/shared.service';
import { Util } from '@app/@shared/util';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { DriveInput } from '@app/common/classes/driveInput';
import { fileCriteria, FileModel } from '@app/common/classes/fileCriteria';
import { FileeCriteria } from '@app/common/classes/fileeCriteria';
//import { ScfService } from '@app/modules/scf/scf.service';
import { Encrypt } from '@app/common/class/encrypt';
import { DriveService } from '@app/services/drive.service';
import { ToastrService } from 'ngx-toastr'
import { Gallery, GalleryItem, ImageItem, ImageSize, ThumbnailsPosition } from '@ngx-gallery/core';
// import { truncateSync } from 'fs';
import { NgxGalleryImage, NgxGalleryOptions } from 'ngx-gallery';
import swal from 'sweetalert';
import {TranslateService} from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ActivatedRoute,Router } from "@angular/router";


declare var require: any;


@Component({
  selector: 'app-filee',
  templateUrl: './filee.html',
  styleUrls: ['./filee.scss'],
  providers: [
    {
      provide: NG_VALUE_ACCESSOR,
      useExisting: forwardRef(() => Filee),
      multi: true
    },
    {
      provide: NG_VALIDATORS,
      useExisting: forwardRef(() => Filee),
      multi: true
    }
  ]
})


export class Filee implements OnInit, OnChanges, ControlValueAccessor {
  galleryOptions: NgxGalleryOptions[];
  galleryImages: NgxGalleryImage[];
  galleryItems: GalleryItem[];
  @Input('isChangebanneredit') isChangebanneredit: boolean;
  valid = false;
  public isdisable : boolean = false
  i18n(key){
    return this.translate.instant(key);
  }

  @ViewChild('bgiDrive') bgiDrive;
  @Input('fileMstRef') fileMstRef: DriveInput;
  @Input() public set disabledrive(value: any) {
    this.isdisable = value;
  }
  public get disabledrive() {
    return this.isdisable;
  }
  @Input('isMandatory') isMandatory: string;
  @Input('notePosition') notePosition: string;
  @Input('fileeCriteria') fileeCriteria: FileeCriteria;
  @Input('isSrcProduct') isSrcProduct: boolean;
  @Input('isLogo') isLogo: boolean;
  @Input('isGallery') isGallery: boolean;
  @Input('isChangebanner') isChangebanner: boolean;
  @Input('isEditbanner') isEditbanner: boolean;
  @Input('uploadimage') uploadimage: boolean;
  @Input('documentupload') documentupload: boolean;
  @Input('logname') logname: string;
  @Input('isDelete') isDelete = false;
  @Input('imagesList') imagesList: any;
  @Input('logoType') logoType: string;
  @Input('requiredfield') requiredfield: boolean = true;
  @Input('datedetials') datedetials: boolean = false;
  @Input('documentname') documentname: boolean = true;
  @Input('deleteicon') deleteicon: boolean = true;
  @Input('notedcontent') notedcontent: boolean = false;
  // @Input('nonote') nonote: boolean = false;
  nonote: boolean = false;
  @Input('showonlyupload') showonlyupload: boolean = false;
  @Output() filesSelected: EventEmitter<number[]> = new EventEmitter<number[]>();
  @Output() filesSelectedDetails: EventEmitter<any> = new EventEmitter<any>();
  @Input('projimg') projimg = false;  
  @Output() filesnewlySelected: EventEmitter<any> = new EventEmitter<any>();
  
  @Output() deleteImageID: EventEmitter<any> = new EventEmitter<any>();
  @Input('paymentNote') paymentNote: boolean = false;
  public fileeSelectedPks: number[] = [];
  public fileCriteria: fileCriteria;
  public disabled: boolean;
  public stkholdertype: any;
  // public useraccess:any;
  public lusrtpye: string;
  public displayRight: boolean;
  public modulepk:any=[];
  @Input('appstatus') appstatus = false;
 @Input('notecontentrequired') notecontentrequired = false;
 @Input('fileuploadcommon') fileuploadcommon: boolean = true;
  @Input('uploaddocumentname') uploaddocumentname: any; @Input('certificate') certificate: boolean = false;
  @Input('uploadexcel') uploadexcel: any;
 constructor(public util: Util,              public driveService: DriveService,
              //public scfService: ScfService,
              public shared: SharedService,
              public encrypt: Encrypt,
            
              private snackBar: MatSnackBar,
              public gallery: Gallery,public toastr: ToastrService,
              private translate: TranslateService,
              private remoteService: RemoteService,
              private cookieService: CookieService,public localstorage: AppLocalStorageServices,public routeid: ActivatedRoute,) {
  }
  onChange = (v) => { };
  onTouched = () => { };
  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
    {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
    dir="ltr"; 
  ngOnInit() {
    this.lusrtpye = this.localstorage.getInLocal('usertype');
    this.stkholdertype = this.localstorage.getInLocal('reg_type');
  //   if(this.lusrtpye == 'U'){
  //     this.useraccess = this.localstorage.getInLocal('uerpermission');
  // } 
    this.setupFilee();
  }
  deleteimage(pk: number) {
    this.deleteImageID.emit(pk);
  }
  basicLightboxExample() {
    this.gallery.ref().load(this.galleryItems);
  }
  get isdrivedisbaled() {
    let isValid = false;  
    if(this.fileeCriteria!=undefined && this.fileeCriteria.selectedFiles.length>=this.fileeCriteria.fileMaxCount){
      isValid = true;
    } else if(this.isdisable){
      isValid = true;
    }
    return isValid;
  }
  withCustomGalleryConfig() {

    // 2. Get a lightbox gallery ref
    const lightboxGalleryRef = this.gallery.ref('anotherLightbox');

    // (Optional) Set custom gallery config to this lightbox
    lightboxGalleryRef.setConfig({
      imageSize: ImageSize.Cover,
      thumbPosition: ThumbnailsPosition.Top
    });

    // 3. Load the galleryItems into the lightbox
    lightboxGalleryRef.load(this.galleryItems);
  }

  ngOnChanges(changes) {
    if (this.imagesList) {
      this.galleryItems = this.imagesList.map(item =>
        new ImageItem({ src: item.filePath, thumb: item.filePath, pk: item.pk })
      );
      this.basicLightboxExample();
      this.withCustomGalleryConfig();
    }
  }


      triggerChange() {
        this.setupFilee();
      }

  setupFilee() {
    this.fileeSelectedPks = (this.fileMstRef.selectedFilesPk);
    this.change(this.fileeSelectedPks);
    this.notePosition = 'bottom';
    if (this.notePosition == null) {
      this.displayRight = true;
    } else {
      this.displayRight = false;
    }
    this.shared.getfilemst(this.fileMstRef.fileMstPk, this.fileMstRef.selectedFilesPk).subscribe(data => {
      let temp_selectedFiles: FileModel[] = [];

      if (data.data != undefined) {

        if (data.data.selected_files != null) {
          temp_selectedFiles = data.data.selected_files;
        }
        console.log('selected files', temp_selectedFiles)
        this.fileeCriteria = {
          fileMstRef: this.fileMstRef.fileMstPk,
          fileName: data.data.fileName,
          fileNote: data.data.fileNote,
          fileFormat: data.data.fileFormat,
          fileSize: data.data.fileSize,
          fileMaxCount: data.data.fileMaxCount,
          fileDimension: data.data.fileDimension,
          fileIsCrop:data.data.fileIsCrop,
          fileCropRatio:data.data.fileCropRatio,
          fileData: '',
          selectedFiles: temp_selectedFiles
        };
      }


    });
  }
  // for validating starts
  writeValue(value) { }
  validate({ value }: FormControl) {
    if (this.isMandatory == 'true') {
      if (value == undefined || value == null) {
        return {
          invalid: false
        };
      }
      if (value.length < 1) {
        return {
          invalid: false
        };
      } else if (value.length > 0) {
        return false;
      }
    } else {
      return false;
    }


  }
  registerOnChange(fn) { this.onChange = fn; }
  registerOnTouched(fn) { this.onTouched = fn; }

  change(value: any) {
    this.onChange(value);
    this.onTouched();
  }

  // for validating ends




  openDrive(data) {
    // let moduleid = this.localstorage.getaccessmoduleid(this.stkholdertype,'Company Information');   
    // if ((this.lusrtpye == 'A') || (this.lusrtpye == 'U' && this.useraccess[moduleid] && this.useraccess[moduleid].create == 'Y')){
    if(!this.isdisable){ 
      if (this.fileeCriteria != undefined) {
          const allowedCount = this.fileeCriteria.fileMaxCount;
          let selectedCount = 0;
          if (this.fileeCriteria.selectedFiles != null) {
          selectedCount = this.fileeCriteria.selectedFiles.length;
        }
          if (selectedCount < allowedCount) {
          this.bgiDrive.openModal(fileCriteria);
        } else {
          this.toastr.warning(this.i18n('uploadfile.youhaveuploa'), ''), {
            timeOut: 4000,
            closeButton: false,
          };
          // this.snackBar.open(this.i18n('uploadfile.youhaveuploa'), '', {
          //   duration: 5000,
          //   panelClass: ['error'],
          //   verticalPosition: 'top'
          // });
          return false;
        }
      } else {
        this.toastr.warning(this.i18n('Please Wait Loading...'), ''), {
          timeOut: 4000,
          closeButton: false,
        };
        // this.snackBar.open(this.i18n('uploadfile.notetodeve'), '', {
        //   duration: 5000,
        //   panelClass: ['error'],
        //   verticalPosition: 'top'
        // });
        return false;
      }
      }
    }
    initializeFileeSelectedPks() {
      this.fileeSelectedPks = [];
    }

  afterFileSeleted(files: any) {
    if(this.fileeSelectedPks == undefined){
      this.initializeFileeSelectedPks();
    }

    // if(files.length==1){
    //   let file=files[0];
    //   if(file.fileType=='png' || file.fileType=='jpg' || file.fileType=='jpeg'){
    //       this.croppy.openDialog(file);
    //   }
    // }
    // console.log('coming from some place');
    // console.log(file);
    // if(file.fileType=='png' || file.fileType=='jpg' || file.fileType=='jpeg'){
    //     this.croppy.openDialog(file);
    // }
    // else{
    //   if(this.isLogo){
    //     this.fileeCriteria.selectedFiles=[];
    //   }
    //   }
    const newlySelectedFilesPk = [];
    const newlySelectedFiles = [];
    if (files instanceof Array) {
      if (files.length > 0 && files != undefined) {
        files.forEach(file => {
          this.fileeCriteria.selectedFiles.push(file);
          this.fileeSelectedPks.push(file.filePk);
          newlySelectedFilesPk.push(file.filePk);
          newlySelectedFiles.push(file);
        });
        this.change(this.fileeSelectedPks);
        
        this.filesSelected.emit(this.fileeSelectedPks);
        this.filesSelectedDetails.emit(this.fileeCriteria.selectedFiles);
        this.filesnewlySelected.emit(newlySelectedFiles);
      }
    }

    this.driveService.mapreference(this.fileMstRef.fileMstPk, newlySelectedFilesPk).subscribe(data => {

      });

    //this.scfService.logdata(this.logname, 1).subscribe(res => {
    //  });

  }
  showTSuccess(data){
    this.toastr.success(data, '', {
        timeOut: 3000,
        closeButton: false,
    });
  }
  afterFileCropped(file: FileModel) {
    if (this.isLogo) {
      this.fileeCriteria.selectedFiles = [];
    }
    this.fileeCriteria.selectedFiles.push(file);
  }
  deleteFile(file: FileModel, index) {
    var flash="Document Deleted Successfully!";
    var projtxt='Do you want to delete this Document?';
    if(this.projimg){
      projtxt="Do you want to delete this Project Image?";
      flash='Project Image Deleted Successfully.';
    }
    swal({
      title: this.i18n('uploadfile.doyouwant'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('uploadfile.nomodal'), this.i18n('uploadfile.yesmodal')],
      dangerMode: true,
      className: this.dir =='ltr'?'swalEng':'swalAr',
      // className: 'swal-delete',
      closeOnClickOutside: false,
    })
      .then((willDelete) => {
        if (willDelete) {
          this.fileeCriteria.selectedFiles.splice(index, 1);
          this.fileeSelectedPks.forEach((item, index) => {                       
            if (item == file.filePk) { this.fileeSelectedPks.splice(index, 1); }
          });
          this.driveService.removereference(this.fileMstRef.fileMstPk, file.filePk).subscribe(data => {

            
          });
          // this.scfService.logdata(this.logname, 2).subscribe(res => {
          // });
          this.change(this.fileeSelectedPks);
          this.filesSelected.emit(this.fileeSelectedPks);
          this.filesSelectedDetails.emit(this.fileeCriteria.selectedFiles);
          this.showTSuccess(flash); 
        }
      });


  }
  getclick(getfileCriteria, fileeCriteria) {
          if (fileeCriteria.selectedFiles.length == 0) {
            console.log(this.bgiDrive);
          this.bgiDrive.openModal(getfileCriteria);
          }      
  }
getAspectRatio(dimension) {
    if (dimension != undefined && dimension != null) {
    const dim = dimension.split('X');
    return ratio(dim[0], dim[1]);
    }
  }

  userPermissionDelete(data,id){
    let moduleid = this.modulepk;
// <<<<<<< HEAD
    // if ((this.loginTypeUser == 'A') || (this.loginTypeUser == 'U'&& this.userAccess[moduleid] && this.userAccess[moduleid].delete== 'Y')){
// =======
    //if ((this.loginTypeUser == 'A') || (this.loginTypeUser == 'U'&& this.userAccess[moduleid] && this.userAccess[moduleid].delete== 'Y')){
// >>>>>>> 272739928069ac3b77eec702d0bef96262b7faf4
      this.deleteFile(data,id);
    // }else if (this.loginTypeUser == 'U' && this.userAccess[moduleid] && this.userAccess[moduleid].delete== 'N') {
    //   this.toastr.warning(this.i18n('uploadfile.youdonthaveperm'), this.i18n('uploadfile.warn'), {
    //     timeOut: 3000,
    //     closeButton: true,
    //   });
    // }
  }
}



function gcd(u, v) {
  if (u === v) { return u; }
  if (u === 0) { return v; }
  if (v === 0) { return u; }

  if (~u & 1) {
      if (v & 1) {
          return gcd(u >> 1, v);
      } else {
          return gcd(u >> 1, v >> 1) << 1;
      }
  }

  if (~v & 1) { return gcd(u, v >> 1); }

  if (u > v) { return gcd((u - v) >> 1, v); }

  return gcd((v - u) >> 1, u);
}

/* returns an array with the ratio */
function ratio(w, h) {
const d = gcd(w, h);
return w / d + ':' + h / d;
}

