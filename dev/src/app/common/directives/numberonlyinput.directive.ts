import { Directive, HostListener, ElementRef, Input } from '@angular/core';

@Directive({
  selector: '[appNumberonlyinput]'
})
export class NumberonlyinputDirective {

  constructor(private el: ElementRef) { }

  @HostListener('input', [ '$event' ])

  onInputChange(event) {
    const initalValue = this.el.nativeElement.value;
    this.el.nativeElement.value = initalValue.replace(/[^0-9]*/g, '');
    if ( initalValue !== this.el.nativeElement.value) {
      event.stopPropagation();
    } else {
      event.stopPropagation();
    }
  }


}
