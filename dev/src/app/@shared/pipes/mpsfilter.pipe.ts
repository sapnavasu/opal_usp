import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'mpsfilter'
})
/* export class FilterPipe implements PipeTransform {

  transform(value: any, args?: any): any {
    return null;
  }

} */
export class MpsfilterPipe implements PipeTransform {
  transform(items: any[], mpssearchText: string): any[] {
    if (!items) { return []; }
    if (!mpssearchText) { return items; }

    return items.filter(item => {
      return Object.keys(item).some(key => {
        return String(item[key]).toLowerCase().includes(mpssearchText.toLowerCase());
      });
    });
   }
}
