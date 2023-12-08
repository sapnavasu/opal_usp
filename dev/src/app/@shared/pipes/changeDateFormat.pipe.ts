import { DatePipe } from '@angular/common';
import { Pipe, PipeTransform } from '@angular/core';
import { BGIConstants } from '@app/common/constantUtils';


@Pipe({name: 'dateFormat'})

export class BGIDateFormat extends DatePipe implements PipeTransform{
    transform(value: any, args?: any): any {
        let newDateFormat: string = super.transform(value,args||BGIConstants.DEFAULT_NEW_DATE_FMT);
        return newDateFormat;
    }
}