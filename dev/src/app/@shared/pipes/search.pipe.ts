import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'searchFilter'
})
export class SearchPipe implements PipeTransform {

  transform(items: any[], searchText: string, keyname: any): any[] {

    if (!items) { return []; }
    if (!searchText) { return items; }
    return this.searchItems(items, searchText.toLowerCase(), keyname.trim());
   }


   private searchItems(arrayValues: any, searchText: any, arrayKey: string): any {
     const results: any = [];
     arrayValues.forEach((arr: any, key: any) => {
      if (arr[arrayKey].toLowerCase().includes(searchText)) {
        results.push(arr);
      }
     });
     return results;
   }

}
