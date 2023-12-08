import { Directive, ElementRef, HostListener } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { InptLang_Var } from '@env/InptLang_Ctrl';

@Directive({
  selector: '[appAlphaname]'
})
export class AlphanameDirective {

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
  constructor(public el: ElementRef,
    private snackBar: MatSnackBar) {
    this.inputElement = el.nativeElement;
  }

  toastModuleWarning(){
    this.snackBar.open(InptLang_Var.appAlphanumsymb_msg,null,{
      duration: 5000,
      panelClass:['warning'],
      horizontalPosition:'right',
      verticalPosition:'top'
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
    var patt = new RegExp(/[a-zA-Z\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDCF\uFDF0-\uFDFF\uFE70-\uFEFF'.\s+]/g);
    var res = patt.exec(e.key);
    if(res == null || (e.key === '+' && e.shiftKey === true)){
      e.stopImmediatePropagation();
      e.preventDefault();
    }
    // Ensure that it is a valid keycode and allow the keypress
    // if (( e.keyCode >= 65 && e.keyCode <= 90 ) || e.keyCode == 32 || (!e.shiftKey && e.keyCode == 222) || (!e.shiftKey && e.keyCode == 190)) {
    //   return true;
    // }else{
    //   e.preventDefault();
    // }
  }

  @HostListener('paste', ['$event'])
  onPaste(event: ClipboardEvent) {
    event.stopImmediatePropagation();
    event.stopPropagation();
    event.preventDefault();
    // event.cancel();
    var pastedInput: string = event.clipboardData.getData('text/plain');
    var patt = new RegExp(/[^a-zA-Z'.\s+]/g);
    var res = pastedInput.match(patt);
    if(res!=null){
      pastedInput = pastedInput.replace(/[^a-zA-Z'.\s+]/g, '');
    }
    else{
      pastedInput = pastedInput.replace(/[^a-zA-Z'.\s+]/g, '');
    }
      // .replace(/[@$-/:-?{-~!"^_`\[\]]/g, ''); // get a digit-only string
    document.execCommand('insertText', false, pastedInput);
  }

  @HostListener('drop', ['$event'])
  onDrop(event: DragEvent) {
    event.preventDefault();
    var textData = event.dataTransfer.getData('text');
    var patt = new RegExp(/[^a-zA-Z'.\s+]/g);
    var res = textData.match(patt);
    if(res!=null){
      textData = textData.replace(/[^a-zA-Z'.\s+]/g, '');
    }
    else{
      textData = textData.replace(/[^a-zA-Z'.\s+]/g, '');
    }
    textData = textData.replace(/[^a-zA-Z'.\s+]/g, '');
    // \s+ is added for allowing space
    this.inputElement.focus();
    document.execCommand('insertText', false, textData);
  }

}
