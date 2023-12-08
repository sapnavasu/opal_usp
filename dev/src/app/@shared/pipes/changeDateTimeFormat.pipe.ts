import { DatePipe } from '@angular/common';
import { Pipe, PipeTransform } from '@angular/core';
import { BGIConstants } from '@app/common/constantUtils';



@Pipe({name:'dateTimeFormat'})

export class BGIDateTimeFormat extends DatePipe implements PipeTransform{
    transform(value:any,args?:any){
        let newDateTimeFormat:string = super.transform(value,args||BGIConstants.DEFAULT_DATE_TIME_FMT);
        return newDateTimeFormat;
    }
}