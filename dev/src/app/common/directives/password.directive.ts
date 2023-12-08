import { Directive, ElementRef, HostListener } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { InptLang_Var } from '@env/InptLang_Ctrl';

@Directive({
  selector: '[appPassword]'
})
export class PasswordDirective {
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
    ) {
      // let it happen, don't do anything
      return;
    }
    // var patt = new RegExp(/[a-zA-Z0-9%^_\[|\]\\-]/g);
    const patt = new RegExp(/[a-zA-Z0-9@'!#$&'*+/=?`{|}~.]/g);
    const res = patt.exec(e.key);
    if (res == null) {
      e.stopImmediatePropagation();
      e.preventDefault();
    }
  }

  @HostListener('paste', ['$event'])
  onPaste(event: ClipboardEvent) {
    event.stopImmediatePropagation();
    event.preventDefault();
  }

  @HostListener('drop', ['$event'])
  onDrop(event: DragEvent) {
    event.preventDefault();
    let textData = event.dataTransfer.getData('text');
    const patt = new RegExp(/[a-zA-Z0-9@'!#$&'*+/=?`{|}~.]/g);
    const res = textData.match(patt);
    if (res != null) {
      textData = textData.replace(/[a-zA-Z0-9@'!#$&'*+/=?`{|}~.]/g, '');
    } else {
      textData = textData.replace(/[a-zA-Z0-9@'!#$&'*+/=?`{|}~.]/g, '');
    }
    textData = textData.replace(/[a-zA-Z0-9@'!#$&'*+/=?`{|}~.]/g, '');
    // \s+ is added for allowing space
    this.inputElement.focus();
    document.execCommand('insertText', false, textData);
  }

}
