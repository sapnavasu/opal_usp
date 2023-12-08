import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'multisearchinput'
})
export class MultisearchinputPipe implements PipeTransform {

  transform(items: any[], searchText: string, keyname: string[]): any[] {

    if (!items) { return []; }
    if (!searchText) { return items; }
    return this.searchItems(items, searchText.toLowerCase(), keyname);
   }


   private searchItems(arrayValues: any, searchText: any, arrayKey: any): any {
     const results: any = [];

     arrayValues.forEach((arr: any) => {
       arrayKey.filter((x: any) => {
         if (arr[x] != null && arr[x] != '') {
        if (arr[x].toLowerCase().includes(searchText)) {
          results.push(arr);
        }
      }
       });
     });
     return results;
   }

}
