import { Directive, ElementRef, HostListener, Input, Output, EventEmitter } from '@angular/core';

@Directive({
  selector: '[appClickOut]'
})
export class ClickOutDirective {

  @Output('clickOutside') clickOutside: EventEmitter<any> = new EventEmitter();

  constructor(private _elementRef: ElementRef) { }

  @HostListener('document:click', ['$event.target']) onMouseEnter(targetElement) {
    const clickedInside = this._elementRef.nativeElement.contains(targetElement);
    if (!clickedInside) {
      this.clickOutside.emit(null);
    }
  }
}
