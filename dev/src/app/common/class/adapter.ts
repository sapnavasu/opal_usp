import { environment } from "environments/environment";

class UploadAdapter { 
  private loader: any;
  public xhr: any;
  //private http: any;
  constructor(loader: any, ) {
    this.loader = loader;
  }

  upload() {
    return this.loader.file
      .then((file: any) => new Promise((resolve, reject) => {
        this._initRequest();
        this._initListeners(resolve, reject, file);
        this._sendRequest(file);
      }));
  };
  // Initializes the XMLHttpRequest object using the URL passed to the constructor.
  _initRequest() {
    const xhr = this.xhr = new XMLHttpRequest();
    xhr.open('POST', environment.baseUrl+'pm/profile/ckeditor', true);
    xhr.responseType = 'json';
  }
  // Initializes XMLHttpRequest listeners. 
  _initListeners(resolve: { (value?: {} | PromiseLike<{}> | undefined): void; (arg0: { default: any; }): void; }, reject: { (reason?: any): void; (arg0: string): void; (): void; (arg0: any): void; }, file: { name: any; }) {
    const xhr = this.xhr;
    const loader = this.loader;
    const genericErrorText = `Couldn't upload file: ${file.name}.`;
    xhr.addEventListener('error', () => reject(genericErrorText));
    xhr.addEventListener('abort', () => reject());
    xhr.addEventListener('load', () => {
      const response = xhr.response;
      if (!response || response.error) {
        return reject(response && response.error ? response.error.message : genericErrorText);
      }
      resolve({
        default: response.data.default
      });
    });
    if (xhr.upload) {
      xhr.upload.addEventListener('progress', (evt: { lengthComputable: any; total: any; loaded: any; }) => {
        if (evt.lengthComputable) {
          loader.uploadTotal = evt.total;
          loader.uploaded = evt.loaded;
        }
      });
    }
  }
  // Prepares the data and sends the request.
  _sendRequest(file: string | Blob) {
    // Prepare the form data.
    const data = new FormData();
    data.append('upload', file);
    this.xhr.send(data);
  }

}