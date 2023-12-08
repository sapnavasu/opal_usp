import { Injectable, ɵConsole } from '@angular/core';
import { RemoteService } from '@app/remote.service';
import { FileUploadArgs } from './../common/classes/fileCriteria';


@Injectable({
  providedIn: 'root'
})
export class DriveService {
  _url = 'drv/drive/';
  constructor(public http: RemoteService) { }
  list(dir) {
    return this.http.get(this._url + 'list?directory=' + dir).map(res => res.json());
  }
  add(newDir) {
    return this.http.get(this._url + 'add?newDirectory=' + newDir).map(res => res.json());
  }
  dataToImage(data) {
    const formData = new FormData();
    formData.append('file', data);
    return this.http.fileupload(this._url + 'datatoimage', formData, {reportProgress: true, observe: 'events'}).map(res => res.json());
  }
  fileupload(files: File[], fileArgs: FileUploadArgs) {
	  return this.uploadAndProgress(files, fileArgs);
  }
  fileuploadTemp(files: File[], fileArgs: FileUploadArgs) {
	  return this.uploadAndProgressTemp(files, fileArgs);
  }

  uploadAndProgress(files: File[], fileArgs: FileUploadArgs) {
    const formData = new FormData();
    Array.from(files).forEach(f => formData.append('file[]', f), formData.append('key', fileArgs.key));
    return this.http.fileupload(this._url + 'upload', formData, {reportProgress: true, observe: 'events'}).map(res => res.json());
  }

  uploadAndProgressTemp(files: File[], fileArgs: FileUploadArgs) {
    const formData = new FormData();
    Array.from(files).forEach(f => formData.append('file[]', f), formData.append('key', fileArgs.key));
    return this.http.fileupload(this._url + 'upload-temp', formData, {reportProgress: true, observe: 'events'}).map(res => res.json());
  }

  cropUploaded(data: Event, file: Blob,fileArgs: FileUploadArgs,fileName:string) {
    const formData = new FormData();
    formData.append('file', file);
    formData.append('key', fileArgs.key);
    formData.append('fileName', fileName);
    return this.http.fileupload(this._url + 'uploadcrop', formData, {reportProgress: true, observe: 'events'}).map(res => res.json());
  }
  test(data) {
    return this.http.post(this._url + 'test', data).map(res => res.json());
  }
  mapreference(fileMstPk, selectedPks) {
    const formParam = JSON.stringify({ 'fileMstPk': fileMstPk, 'selectedPks': selectedPks });
    return this.http.post(this._url + 'mapreference', formParam).map(res => res.json());
  }
  removereference(fileMstPk, selectedPk) {
    const formParam = JSON.stringify({ 'fileMstPk': fileMstPk, 'selectedPks': selectedPk });
    return this.http.post(this._url + 'removereference', formParam).map(res => res.json());
  }
  removefile(fileMstPk, selectedPk) {
    const formParam = JSON.stringify({ 'fileMstPk': fileMstPk, 'selectedPks': selectedPk });
    return this.http.post(this._url + 'removefile', formParam).map(res => res.json());
  }
}
