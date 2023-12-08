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
import { InptLang_Var } from '@env/InptLang_Ctrl';
@Directive({
  selector: '[appAlphanumsymb]'
})
export class AlphanumsymbDirective {
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

  // message configuration in InptLang_Var
  toastModuleWarning() {
    this.snackBar.open(InptLang_Var.appAlphanumsymb_msg, null, {
      duration: 5000,
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
      // (e.key === 'لا') // block b allowed on arabic keyboard
    ) {
      // let it happen, don't do anything
      return;
    }
    let inputVal:any = 0;
    if((this.el.nativeElement as HTMLInputElement).value){
      inputVal = (this.el.nativeElement as HTMLInputElement).value.trim();
    }
    let inputMaxLength:any = 0;
    if((this.el.nativeElement as HTMLInputElement).maxLength){
      inputMaxLength = (this.el.nativeElement as HTMLInputElement).maxLength;
    }
    if (inputMaxLength > 0 && inputMaxLength <= inputVal.length) {
      e.stopImmediatePropagation();
      e.preventDefault();
    }
    // Ensure that it is a number and stop the keypress
    let patt = new RegExp(/[a-zA-Z0-9@'!#$%&':*+/=?^_`{|},<>;"\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDCF\uFDF0-\uFDFF\uFE70-\uFEFF)\\[\](~.-\s+]/g);
    let res = patt.exec(e.key);
    if (res == null) {
      e.stopImmediatePropagation();
      e.preventDefault();
      this.toastModuleWarning();
    }
    // if ((!e.shiftKey && (e.keyCode < 32 || e.keyCode > 126)&& (e.keyCode < 186 || e.keyCode > 222) )) {
    //   e.preventDefault

  }
  @HostListener('paste', ['$event'])
  blockPaste(e: KeyboardEvent) {
    e.preventDefault();
  }
  onPaste(event: ClipboardEvent) {
    event.stopImmediatePropagation();
    event.stopPropagation();
    event.preventDefault();
    // event.cancel();
    let pastedInput: string = event.clipboardData.getData('text/plain');
    let patt = new RegExp(/[^a-zA-Z0-9@'!#$%&':*+/=?^_`{|},<>;")\\[\](~.-\s+]/g);
    let res = pastedInput.match(patt);
    if (res != null) {
      this.toastModuleWarning();
      pastedInput = pastedInput.replace(/[^a-zA-Z0-9@'!#$%&':*+/=?^_`{|},<>;")\\[\](~.-]/g, ' ');
    } else {
      pastedInput = pastedInput.replace(/[^a-zA-Z0-9@'!#$%&':*+/=?^_`{|},<>;")\\[\](~.-\s+]/g, ' ');
    }
    // .replace(/[0-9@$-/:-?{-~!"^_`\[\]]/g, ''); // get a digit-only string
    pastedInput = pastedInput.replace(/\s{2,}/g, ' ');
    document.execCommand('insertText', false, pastedInput);
  }

  @HostListener('drop', ['$event'])
  onDrop(event: DragEvent) {
    event.preventDefault();
    let textData = event.dataTransfer.getData('text');
    let patt = new RegExp(/[^a-zA-Z0-9@'!#$%&':*+/=?^_`{|},<>;")\\[\](~.-\s+]/g);
    let res = textData.match(patt);
    if (res != null) {
      this.toastModuleWarning();
      textData = textData.replace(/[^a-zA-Z0-9@'!#$%&':*+/=?^_`{|},<>;")\\[\](~.-]/g, ' ');
    } else {
      textData = textData.replace(/[^a-zA-Z0-9@'!#$%&':*+/=?^_`{|},<>;")\\[\](~.-\s+]/g, ' ');
    }
    textData = textData.replace(/[^a-zA-Z0-9@':!#$%&'*+/=?^_`{|},<>;")\\[\](~.-\s+]/g, ' ');

    textData = textData.replace(/\s{2,}/g, ' ');
    // \s+ is added for allowing space
    this.inputElement.focus();
    document.execCommand('insertText', false, textData);
  }

}
