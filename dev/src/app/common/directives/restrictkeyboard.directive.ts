import { Directive, HostListener, Input } from '@angular/core';

@Directive({
  selector: '[restrictKeyboard]'
})
export class RestrictkeyboardDirective {
  @Input() restrictInputFromKeyboard: boolean;

  constructor() { }

  @HostListener('keydown', ['$event']) onKeyDown(e: KeyboardEvent) {
    if (this.restrictInputFromKeyboard) {
      e.preventDefault();
    }
  }
}
