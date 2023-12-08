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
import { Directive, ElementRef, HostListener } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';

@Directive({
  selector: '[appAlphanum]'
})
export class AlphanumDirective {
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
  constructor(public el: ElementRef,
              private snackBar: MatSnackBar) {
    this.inputElement = el.nativeElement;
  }


  toastModuleWarning() {
    this.snackBar.open('JSRS supports only English as an input in any field!', null, {
      duration: 2000,
      panelClass: ['warning'],
      horizontalPosition: 'right',
      verticalPosition: 'top'
      });
  }

  @HostListener('keydown', ['$event'])
  onKeyDown(e: KeyboardEvent) {
    if (
      this.navigationKeys.indexOf(e.key) > -1 || // Allow: navigation keys: backspace, delete, arrows etc.
      (e.key === 'a' && e.ctrlKey === true) || // Allow: Ctrl+A
      (e.key === 'c' && e.ctrlKey === true) || // Allow: Ctrl+C
      (e.key === 'v' && e.ctrlKey === true) || // Allow: Ctrl+V
      (e.key === 'x' && e.ctrlKey === true) || // Allow: Ctrl+X
      (e.key === 'a' && e.metaKey === true) || // Allow: Cmd+A (Mac)
      (e.key === 'c' && e.metaKey === true) || // Allow: Cmd+C (Mac)
      (e.key === 'v' && e.metaKey === true) || // Allow: Cmd+V (Mac)
      (e.key === 'x' && e.metaKey === true) // Allow: Cmd+X (Mac)
    ) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    // alert(String.fromCharCode(e.keyCode)+" "+e.keyCode);
    let patt = new RegExp(/[a-zA-Z0-9\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDCF\uFDF0-\uFDFF\uFE70-\uFEFF\s+]/g);
    let res = patt.exec(e.key);
    if (res == null) {
      e.preventDefault();
      // this.toastModuleWarning();
    }
    // if ((!e.shiftKey && (e.keyCode < 32 || e.keyCode > 126)&& (e.keyCode < 186 || e.keyCode > 222) )) {
    //   e.preventDefault

  }

  @HostListener('paste', ['$event'])
  onPaste(event: ClipboardEvent) {
    event.preventDefault();
    const pastedInput: string = event.clipboardData
      .getData('text/plain').replace(/[^a-zA-Z0-9\s+]/g, '');
      // .replace(/[0-9@$-/:-?{-~!"^_`\[\]]/g, ''); // get a digit-only string
  // document.execCommand('insertText', false, pastedInput);
   
  }

  @HostListener('drop', ['$event'])
  onDrop(event: DragEvent) {
    event.preventDefault();
    const textData = event.dataTransfer.getData('text').replace(/[^a-zA-Z0-9\s+]/g, '');
    // \s+ is added for allowing space
    this.inputElement.focus();
    document.execCommand('insertText', false, textData);
  }

}
