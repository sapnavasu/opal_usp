import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'disableoptions'
})
export class DisableoptionsPipe implements PipeTransform {

  transform(items: any, currentValue: string, delimiter?: any, limit?: number): boolean {
    if (!items) { return false; }
    if (!currentValue) { return false; }
    return this.searchItems(items, currentValue, delimiter, limit);
   }


   private searchItems(arrVal: any, currentIndexVal: any, delimiter?: any, limit?: number): boolean {
    if (delimiter) {
      arrVal = arrVal.map((x: any) => x.split(delimiter)[1]);
    }

    return ((arrVal[0] == 0 && currentIndexVal !== 0)
    ||
    (arrVal.length > limit && !arrVal.includes(currentIndexVal)));
   }

}
