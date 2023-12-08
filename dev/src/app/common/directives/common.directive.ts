import { Directive, ElementRef, Input } from '@angular/core';
import Inputmask from 'inputmask';


@Directive({
  selector: '[app-restrict-input]',
})
export class RestrictInputDirective {

  // map of some of the regex strings I'm using (TODO: add your own)
  private regexMap = {
    integer: '^[0-9]*$',
    numberonly: '^[1-9][0-9]*$',
    float: '^[+-]?([0-9]*[.])?[0-9]+$',
    words: '([A-z]*\\s)*',
    point25: '^\-?[0-9]*(?:\\.25|\\.50|\\.75|)$',
    wordsandnumber:'^[a-zA-Z0-9._-\\s]+$',
    firstspace:'^[^\\s]+(\\s+[^\\s]+)*$',
    //firstspace:'[ \t]+$',
    characters:'^[a-zA-Z][a-zA-Z\\s]+$',
    alphanumeric:'^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$',
    numeric:'^(0|[1-9][0-9]*)$',
    decimalnumeric:'^[0-9](\\.[0-9]+)?$',
    negativedecimal:'^-\\d*\\.?\\d+$',
    optionone:'^[\a-zA-Z0-9&.()\'\- ]+$',
    zero:'^([1-9]*|[1-9]*\.[1-9]{1}?[1-9]*)$',
    arabic:'^[\u0621-\u064A0-9 ]+$', 
    english:"^[a-zA-Z.'&()-^\\s]+$",
    englisharabic:"^[a-zA-Z\u0621-\u064A.'&()-^\\s]+$",
    englisharabicname:"^[a-zA-Z\u0621-\u064A.\\s]+$",
    emailvalid: "^[a-zA-Z0-9-.@]+$",
    numspecsymbol:'^[a-zA-Z0-9/]+$',
    numanddecimal:'^([0-9]*[.])?[0-9]+$',
    percentage:'^\\d{1,2}(\\.\\d{1,2})?|100(\\.00?)?$',
    percentagevalue:'^\\d{1,2}(\\.\\d{1}\\d(%))?|100(\\.00?)?$',
    thirtydigitdecimal:'^([0-9]{1,30})(\\.[0-9]{1,2})?$',
    englishspace:"^[a-zA-Z.'&()-_]+(\\s+[a-zA-Z.'&()-_]+)*$",
    englishkeyboard:"^[a-zA-Z0-9.'&()-]+(\\s+[a-zA-Z0-9.'&()-]+)*$",
    englishkeyboardnospace:"^[a-zA-Z0-9.'-]+([a-zA-Z0-9.'-]+)*$",
    englishandspecialcharcrter:"^[a-zA-Z.'!#$%&'*+/=?^_`{|}-]+(\\s+[a-zA-Z.'!#$%&'*+/=?^_`{|}-]+)*$",
    arabicandspecialcharcrter:"^[\u0621-\u064A.'!#$%&'*+/=?^_`{|}-]+(\\s+[\u0621-\u064A\s.'!#$%&'*+/=?^_`{|}-]+)*$", 
    arabictextonly:'^[\u0621-\u064A ]+$', 
  };

  constructor(private el: ElementRef) {}

  @Input('app-restrict-input')
  public set defineInputType(type: string) {
    Inputmask({regex: this.regexMap[type], placeholder: ''})
      .mask(this.el.nativeElement);
  }

}
