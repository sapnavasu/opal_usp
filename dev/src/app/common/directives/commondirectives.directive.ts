import { Directive, HostListener, ElementRef, Input } from '@angular/core';

@Directive({
  selector: 'input[alphanumeric]'
})
export class CommondirectivesDirective {

  constructor(private el: ElementRef) { }

  @HostListener('input', [ '$event' ])

  onInputChange(event) {
    const initalValue = this.el.nativeElement.value;
    this.el.nativeElement.value = initalValue.replace(/[^A-Za-z0-9]*/g, '');
    if ( initalValue !== this.el.nativeElement.value) {
      event.stopPropagation();
    }
  }



}



