import { FileModel } from "./fileCriteria";

export class FileeCriteria {
  fileMstRef?: number;
  fileName: string;
  fileNote: string;
  fileFormat: string;
  fileSize: any;
  fileMaxCount: number;
  fileData: string;
  fileDimension?: string;
  fileIsCrop?:number;
  fileCropRatio?:number;
  selectedFiles?:FileModel[];
  deletedFilesPk?:number[];
}
