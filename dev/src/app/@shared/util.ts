import { Injectable } from '@angular/core';
import { FileModel } from './../common/classes/fileCriteria';
import { SharedService } from './shared.service';
@Injectable()
export class Util {
  constructor(public shared: SharedService) {}

  public mobileNumberDisplay(countryCode, mobileNumber) {
    if (countryCode == '' || countryCode == null) {
        return mobileNumber;
    } else {
        return countryCode + ' - ' + mobileNumber;
    }
  }
  public phoneNumberDisplay(countryCode, mobileNumber, ext) {
    let phoneNumber = '';
    if (countryCode == '' || countryCode == null) {
      phoneNumber += mobileNumber;
    } else {
      phoneNumber += countryCode + ' - ' + mobileNumber;
    }
    if (ext != '' && ext != null) {
      phoneNumber += '/' + ext;
    }
    return phoneNumber;
  }
public thumbnailByFileType(filetype) {
	switch (filetype) {
      case 'pdf':
        return 'pdf';
        break;
      case 'jpg':
        return 'jpg';
        break;
      case 'jpeg':
        return 'jpeg';
        break;
      case 'png':
        return 'png';
        break;
      case 'xls':
        return 'xls';
        break;
      case 'xlsx':
        return 'xlsx';
        break;
      case 'doc':
        return 'doc';
        break;
      case 'docx':
        return 'docx';
        break;
      default:
      return '';
      break;
    }
}
public fileSrcPath(file: FileModel) {
  return file.fileUrl;
}
public fileImageSrcPath(file: FileModel) {
   return file.fileUrl;
}




}
