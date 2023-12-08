import { Directive, HostListener } from '@angular/core';

@Directive({
  selector: '[blockCopyPaste]'
})
export class BlockCopyPasteDirective {
  constructor() { }

  @HostListener('keydown', ['$event']) blockKeydown(e: KeyboardEvent) {
    var patt = new RegExp(/[^\s]+(\s+[^\s]+)*$/g);
    var res = patt.exec(e.key);
    if(res == null){
      e.stopImmediatePropagation();
      e.preventDefault();
    }
  }

  @HostListener('paste', ['$event']) blockPaste(e: KeyboardEvent) {
    e.stopImmediatePropagation();
    e.preventDefault();
  }

  @HostListener('copy', ['$event']) blockCopy(e: KeyboardEvent) {
    e.preventDefault();
  }

  @HostListener('cut', ['$event']) blockCut(e: KeyboardEvent) {
    e.preventDefault();
  }
}
