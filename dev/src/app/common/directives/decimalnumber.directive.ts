import { Directive, ElementRef, HostListener } from '@angular/core';

@Directive({
  selector: '[appDecimalnumber]'
})
export class DecimalnumberDirective {
  DIGITS_REGEXP = new RegExp(/\D?\d{0,2}/g);
  // Allow decimal numbers and negative values
  private regex: RegExp = new RegExp(/^\d*\.?\d{0,2}$/g);
  // Allow key codes for special events. Reflect :
  // Backspace, tab, end, home
  private specialKeys: Array<string> = ['Backspace', 'Tab', 'End', 'Home', 'ArrowLeft', 'ArrowRight', 'Del', 'Delete'];

  constructor(private el: ElementRef) {

this.el.nativeElement.onpaste = (e: any) => {
  e.preventDefault();
  let text;
  const clp = (e.originalEvent || e).clipboardData;
  if (clp === undefined || clp === null) {
  text = (window as any).clipboardData.getData('text') || '';
  if (text !== '') {
  text = text.replace(this.DIGITS_REGEXP, '');
  if (window.getSelection) {
  const newNode = document.createElement('span');
  newNode.innerHTML = text;
  window.getSelection().getRangeAt(0).insertNode(newNode);
  } else {
  (window as any).selection.createRange().pasteHTML(text);
  }
  }
  } else {
  text = clp.getData('text/plain') || '';
  if (text !== '') {
  text = text.replace(this.DIGITS_REGEXP, '');
  document.execCommand('insertText', false, text);
  }
  }
  };
  }

  @HostListener('keydown', ['$event'])
  onKeyDown(event: KeyboardEvent) {
    // Allow Backspace, tab, end, and home keys
    if (this.specialKeys.indexOf(event.key) !== -1) {
      return;
    }
    const current: string = this.el.nativeElement.value;
    const position = this.el.nativeElement.selectionStart;
    const next: string = [current.slice(0, position), event.key == 'Decimal' ? '.' : event.key, current.slice(position)].join('');
    if (next && !String(next).match(this.regex)) {
      event.preventDefault();
    }
  }

  // @HostListener('paste', ['$event'])
  // onPaste(event: ClipboardEvent) {
  //   event.preventDefault();
  //   const pastedInput: string = event.clipboardData
  //     .getData('text/plain').replace(/[^0-9.]/g, '');
  //     // .replace(/[0-9@$-/:-?{-~!"^_`\[\]]/g, ''); // get a digit-only string
  //   document.execCommand('insertText', false, pastedInput);
  // }

}
