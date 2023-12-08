import { Directive, ElementRef, HostListener } from '@angular/core';

@Directive({
  selector: '[loginname]'
})
export class LoginnameDirective {

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
  inputElement: HTMLElement;
  constructor(public el: ElementRef) {
    this.inputElement = el.nativeElement;
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
    var patt = new RegExp(/[a-zA-Z0-9@.+\s+]/g);
    var res = patt.exec(e.key);
    if(res == null || (e.key === '+' && e.shiftKey === true)) {
      e.stopImmediatePropagation();
      e.preventDefault();
    }
  }

  @HostListener('paste', ['$event'])
  onPaste(event: ClipboardEvent) {
    
    const orignalInput: string = event.clipboardData
    .getData('text/plain');
    var rePattern = /[a-zA-Z0-9@.+\s+]/g;
    var res =  orignalInput.match(rePattern);
    var finaltext= res.join('')
    document.execCommand('selectAll',false,orignalInput);
    document.execCommand('delete',false,orignalInput);
    document.execCommand('insertText',false,finaltext);
    event.preventDefault();
 
   
    
    
  }
  
 
  @HostListener('drop', ['$event'])
  onDrop(event: DragEvent) {
    const orignalInput: string = event.dataTransfer
      .getData('text/plain')
      var rePattern = /[a-zA-Z0-9@.+\s+]/g;
      var res =  orignalInput.match(rePattern);
      var finaltext= res.join('')
      document.execCommand('selectAll',false,orignalInput);
      document.execCommand('delete',false,orignalInput);
      document.execCommand('insertText',false,finaltext);
      event.preventDefault();
  }

}
