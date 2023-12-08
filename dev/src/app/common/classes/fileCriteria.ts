export class fileCriteria{  
  documentName: string;
  isMultiple: boolean; //true for multiple
  maxFile: number;
  maxFileSize: number;
  allowedExtension: string; // pdf,jpeg,jpg
}

export interface FileModel {
  fileName: string;
  fileSize: string;
  fileType: string;
  fileModified: string;
  fileUrl: string;
  imageUrl?: string;
  filePk?: number;
  isDisabled?:boolean; 
  tooltip?:string; 
  link?:string;
}
export interface FileUploadArgs{
  key:any;
}