import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient, HttpHeaders, HttpEvent, HttpParams, HttpRequest } from '@angular/common/http';
import 'rxjs/add/observable/of';
import { RemoteService } from '@app/remote.service';
const URL = 'http://' + window.location.hostname + '/lypis/api/modules/mst/masters/eventupload/uploadfiles';
const dataurl = 'pm/profile/';
@Injectable()
export class FileuploadService {
    //url=
    private serviceURL = URL;
    public uploadBaseFolder = 'uploads/';
    public imageListCache = [];

    constructor(private http: RemoteService) { }

    /* postFile(fileToUpload: File, fileName: string): Observable<any> {
         this.imageListCache = [];
         return this.http.post(this.serviceURL, fileToUpload,
             { headers: {'filename': fileName});
     }*/
    dataupdate(tablename: string, formavalue: any) {

        if (tablename == 'memcompprofiledtls') {
            var body = JSON.stringify({ 'memcompprofiledtls': formavalue });
        }
        else if (tablename == 'memcompgendtls')
        {
            var body = JSON.stringify({ 'memcompgendtls': formavalue });
        }
        return this.http.post(dataurl+"singleinsertion", body).map(res => res.json());     
    }
    getdatafromserver() {
        return this.http.get(dataurl+"gethomeprofile").map(res => res.json());
    }
    getdatafromserverMangement() {
        return this.http.get(dataurl+"getmanagement").map(res => res.json());
    }
    getContactInfo() {
        return this.http.get(dataurl+'getcontactinfo?').map(res=>res.json());
      } 
}
