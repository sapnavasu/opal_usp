import { Directive, ElementRef, Renderer2 } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';

// __          __              _
// \ \        / /             (_)
//  \ \  /\  / /_ _ _ __ _ __  _ _ __   __ _
//   \ \/  \/ / _` | '__| '_ \| | '_ \ / _` |
//    \  /\  / (_| | |  | | | | | | | | (_| |
//     \/  \/ \__,_|_|  |_| |_|_|_| |_|\__, |
//                                      __/ |
//                                     |___/

// Please dont remove or edit the directive it may affect some
// other part of code, commented or ==>>dead<== code is for
// developers refrence. Dev - Ayush.
// import { Directive, ElementRef, HostListener } from '@angular/core';

@Directive({
  selector: '[appAlphanumsymbck]'
})
export class AlphanumsymbckDirective {
  inputElement: HTMLElement;

  private navigationKeys = [
    'Backspace',
    'Delete',
    'Tab',
    'Escape',
    'Enter',
    'Home',
    'End',
    'ArrowLeft',
    'ArrowRight',
    'Clear',
    'Copy',
    'Paste'
  ];


  constructor(el: ElementRef, renderer: Renderer2,  private snackBar: MatSnackBar) {
    let events = 'cut copy paste';
    events.split(' ').forEach(e =>
    renderer.listen(el.nativeElement, e, (event) => {
      event.preventDefault();
      })
    );

}

  toastModuleWarning() {
    this.snackBar.open('OPAL supports only English and Arabic as an input in any field !', null, {
      duration: 5000,
      panelClass: ['warning'],
      horizontalPosition: 'right',
      verticalPosition: 'top'
      });
  }
}
