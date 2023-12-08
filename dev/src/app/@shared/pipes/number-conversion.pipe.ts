import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'numberConversion'
})
export class NumberConversionPipe implements PipeTransform {
  transform(input: any, args?: any): any {
    var exp, rounded,
      suffixes = ['k', 'M', 'B', 'T', 'P', 'E'];

    if (Number.isNaN(input)) {
      return null;
    }

    if (input < 999999) {
      return input;
    }

    exp = Math.floor(Math.log(input) / Math.log(1000));

    return (input / Math.pow(1000, exp)).toFixed(args) + suffixes[exp - 1];

  }

}
