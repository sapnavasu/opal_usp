import { Pipe, PipeTransform } from '@angular/core';

@Pipe({ name: 'displayDepartment' })
export class displayDepartmentPipe implements PipeTransform {
  transform(short:string): string {
    let returnValue='';
    switch (short) {
      case 'BH':
        returnValue='Business Head';
        break;
      case 'M':
        returnValue='Marketing';
        break;
      case 'BA':
        returnValue='Business Administration';
        break;
      case 'J':
        returnValue='JSRS Validation Contact';
        break;
      case 'JP':
        returnValue='JSRS Procurement contact';
        break;
      case 'F':
        returnValue='Finance';
        break;
    
      default:
        returnValue='Finance';
        break;
      }
      return returnValue;
  }
}

@Pipe({
 name: 'truncate'
})
export class TruncatePipe implements PipeTransform {
transform(value: string, args: string[]): string {
    const limit = args.length > 0 ? parseInt(args[0], 10) : 20;
    const trail = args.length > 1 ? args[1] : '...';
    return value.length > limit ? value.substring(0, limit) + trail : value;
   }
}