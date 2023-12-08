import { Component, EventEmitter, Inject, OnInit, Output, ViewEncapsulation } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { Dimensions, ImageCroppedEvent, ImageTransform } from '@app/modules/image-cropper/interfaces';
import { base64ToFile } from '@app/modules/image-cropper/utils/blob.utils';
// import { Dimensions, ImageCroppedEvent, ImageTransform } from '@app/common/image-cropper/interfaces';
// import { base64ToFile } from '@app/common/image-cropper/utils/blob.utils';



@Component({
    selector: './crop-dialog',
    templateUrl: './crop-dialog.html',
    encapsulation: ViewEncapsulation.None,

    styleUrls: ['./crop-dialog.scss'],
})
export class Cropdialog implements OnInit {
    value = 'Only me';
    imageChangedEvent: any = '';
    croppedImage: any = '';
    canvasRotation = 0;
    rotation = 0;
    fileOriName:string;
    scale = 1;
    aspectRatio:number=1;
    base64String: any;
    showCropper = false;
    containWithinAspectRatio = false;
    transform: ImageTransform = {};
    loaderoff = false;
    @Output() loaderoffChange: EventEmitter<boolean> = new EventEmitter<boolean>();


    searchOptions=[
        {'value':1,'name':'Only me'},
        {'value':2,'name':'Organization'},
        {'value':3,'name':'Public'}
      ];
    constructor(
        public dialogRef: MatDialogRef<Cropdialog>,
        @Inject(MAT_DIALOG_DATA) public data: any) { }

    ngOnInit() {
        this.imageChangedEvent=this.data.fileData;
        this.fileOriName=this.data.fileName;
        this.aspectRatio=this.data.ratio;
        // this.getBase64(`https://file-examples-com.github.io/uploads/2017/10/file_example_PNG_500kB.png`)
    }
    getBase64(imgUrl) {
        const self = this;
        var xhr = new XMLHttpRequest();
        xhr.open("get", imgUrl, true);
        // Essential
        xhr.responseType = "blob";
        xhr.onload = function () {
          if (this.status == 200) {
            //Get a blob objects
            var blob = this.response;
            //  Essential
            let oFileReader = new FileReader();
            oFileReader.onloadend = function (e) {
              let base64 = e.target;
              self.base64String = (<any>base64).result;
            };
            oFileReader.readAsDataURL(blob);
            //==== In order to display the picture on the page, you can delete ====
            // var img = document.createElement("img");
            // img.onload = function (e) {
            //   window.URL.revokeObjectURL(img.src); //  Clear release
            // };
            // let src = window.URL.createObjectURL(blob);
            // img.src = src
            // document.getElementById("container1").appendChild(img);
            //==== In order to display the picture on the page, you can delete ====
       
          }
        }
        xhr.send();
       }
    onNoClick(): void {
        this.dialogRef.close();
        this.loaderoffChange.emit(false);
    }
    fileChangeEvent(event: any): void {
        this.imageChangedEvent = event;
    }
    
    imageCropped(event: ImageCroppedEvent) {
        this.croppedImage = event.base64;
    }
    
    imageLoaded() {
        this.showCropper = true;
    }
    
    cropperReady(sourceImageDimensions: Dimensions) {
    }
    
    loadImageFailed() {
    }
    
    rotateLeft() {
        this.canvasRotation--;
        this.flipAfterRotate();
    }
    
    rotateRight() {
        this.canvasRotation++;
        this.flipAfterRotate();
    }
    
    private flipAfterRotate() {
        const flippedH = this.transform.flipH;
        const flippedV = this.transform.flipV;
        this.transform = {
            ...this.transform,
            flipH: flippedV,
            flipV: flippedH
        };
    }
    
    
    flipHorizontal() {
        this.transform = {
            ...this.transform,
            flipH: !this.transform.flipH
        };
    }
    
    flipVertical() {
        this.transform = {
            ...this.transform,
            flipV: !this.transform.flipV
        };
    }
    
    resetImage() {
        this.scale = 1;
        this.rotation = 0;
        this.canvasRotation = 0;
        this.transform = {};
    }
    
    zoomOut() {
        this.scale -= .1;
        this.transform = {
            ...this.transform,
            scale: this.scale
        };
    }
    
    zoomIn() {
        this.scale += .1;
        this.transform = {
            ...this.transform,
            scale: this.scale
        };
    }
    
    toggleContainWithinAspectRatio() {
        this.containWithinAspectRatio = !this.containWithinAspectRatio;
    }
    
    updateRotation() {
        this.transform = {
            ...this.transform,
            rotate: this.rotation
        };
    }
      
    uploadcrop(){
        this.dialogRef.close({data: this.imageChangedEvent,file:base64ToFile(this.croppedImage),fileName:this.fileOriName});
    }
}