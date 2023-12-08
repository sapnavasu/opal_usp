import { Pipe, PipeTransform } from '@angular/core';
import { DecimalPipe } from '@angular/common';

@Pipe({
  name: 'numberSuffix'
})
export class NumberSuffixPipe implements PipeTransform {
  /*constructor(private decimalPipe: DecimalPipe) {

  }
  transform(value: any, digits?: any): any {
      return this.decimalPipe.transform(value / 1000000, digits) + ' M';
  }*/
  constructor() {
  }
  transform(value: string, digits?: any): any {
    let numberofzeros, input, inputlength, bforedotlength, beforedot, afterdot, initial;
    numberofzeros = value.indexOf(".")!=-1 ? (value.split('.')[1].length+6) : 6;
    
    
    input = value.replace('.','');
    inputlength = input.length
    if(inputlength>numberofzeros){
    bforedotlength = input.length-numberofzeros; 
    beforedot = input.slice(0,bforedotlength);
    afterdot = (input.slice(bforedotlength,input.length)).replace(/0+$/g, "");;
      return beforedot+'.'+afterdot+'M';
    }else{
   /* // initial = '0.';
    beforedot = '0.'
      if(numberofzeros>6){
         
      }else{
    
        
      }
      for(let i=0; i<(numberofzeros - inputlength);i++){
        beforedot+='0';
      }
      return beforedot+input+'M';*/
      return value;     
    }
  }
}
