import { AbstractControl, ValidationErrors } from '@angular/forms';

export interface DriveInput {
  fileMstPk: number;
  selectedFilesPk?: number[];
  selectedFilesDetails?: any[];
  deletedFilesPk?: number[];
}


export function ValidateDrive(control: AbstractControl): ValidationErrors | null {
  if (control.value !== null && control.value.length < 1) {
   return { validDrive: true };
 }
  return null;
}
