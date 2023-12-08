import { Component, OnInit, Input, ChangeDetectionStrategy, AfterViewInit, ChangeDetectorRef } from '@angular/core';
import Keyboard from 'simple-keyboard';
import { FormControl } from '@angular/forms';

const firstRow = ['0', '9', '8', '7', '6', '5', '4', '3', '2', '1'];
const secondRow = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', , 'p'];
const thirdRow = ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'];
const fourthRow = ['z', 'x', 'c', 'v', 'b', 'n', 'm'];
@Component({
  selector: 'app-virtual-keyboard',
  template: `<div *ngIf="showKeyboard" class="simple-keyboard"></div>`,
  styleUrls: [
    './virtual-keyboard.component.scss',
    // '../../node_modules/simple-keyboard/build/css/index.css'
  ]
})
export class VirtualKeyboardComponent implements OnInit, AfterViewInit {
  keyboard: Keyboard;
  showKeyboard = false;
  @Input() inputControl: FormControl;
  constructor(private cdr: ChangeDetectorRef) { }

  ngOnInit() {
  }

  ngAfterViewInit() {
    this.initializeKeyboard();
  }

  changeOrder = (
    items: String[],
    isNumeric: boolean = false
  ): { lowerShuffle: string; upperShuffle?: string } => {
    let rowSmallShuffle = '',
      rowCapsShuffle = '';
    items
      .sort(() => Math.random() - 0.5)
      .forEach(item => {
        rowSmallShuffle += item + ' ';
        if (!isNumeric) {
          rowCapsShuffle += item.toUpperCase() + ' ';
        }
      });
    return isNumeric
      ? { lowerShuffle: rowSmallShuffle }
      : { lowerShuffle: rowSmallShuffle, upperShuffle: rowCapsShuffle };
  }

  getChangedLayout = (): { default: any[], shift: any[] } => {
    const { lowerShuffle: firstRowCommonShuffle } = this.changeOrder(firstRow, true);
    const {
      lowerShuffle: secondRowSmallShuffle,
      upperShuffle: secondRowCapsShuffle
    } = this.changeOrder(secondRow);
    const {
      lowerShuffle: thirdRowSmallShuffle,
      upperShuffle: thirdRowCapsShuffle
    } = this.changeOrder(thirdRow);
    const {
      lowerShuffle: fourthRowSmallShuffle,
      upperShuffle: fourthRowCapsShuffle
    } = this.changeOrder(fourthRow);

    const layout = {
      default: [
        '` ' + firstRowCommonShuffle + '- = {bksp}',
        '{tab} ' + secondRowSmallShuffle + '[ ] \\',
        '{lock} ' + thirdRowSmallShuffle + '; \' {enter}',
        '{shift} ' + fourthRowSmallShuffle + ', . / {shift}',
        '.com @ {space}'
      ],
      shift: [
        '~ ! @ # $ % ^ & * ( ) _ + {bksp}',
        '{tab} ' + secondRowCapsShuffle + '{ } \\',
        '{lock} ' + thirdRowCapsShuffle + ': " {enter}',
        '{shift} ' + fourthRowCapsShuffle + '< > ? {shift}',
        '.com @ {space}'
      ],
      caps: [
        '` ' + firstRowCommonShuffle + '- = {bksp}',
        '{tab} ' + secondRowCapsShuffle + '[ ] \\',
        '{lock} ' + thirdRowCapsShuffle + '; \' {enter}',
        '{shift} ' + fourthRowCapsShuffle + ', . / {shift}',
        '.com @ {space}'
      ]
    };

    return layout;
  }


  initializeKeyboard() {
    if (this.showKeyboard) {
      setTimeout(() => {
        this.keyboard = new Keyboard({
          onChange: input => this.onChange(input),
          onKeyPress: button => this.onKeyPress(button),
          layout: this.getChangedLayout()
        });
        // this.cdr.detectChanges();
      }, 500);
    }
  }

  onChange = (input: string) => {
  }

  onKeyPress = (button: string) => {
    const nonAlphaKeys = ['{tab}', '{lock}', '{shift}', '{enter}', '{space}'];
    if (!nonAlphaKeys.includes(button) && button != '{bksp}') {
      this.inputControl.setValue(this.inputControl.value + button);
    } else if (button == '{bksp}') {
      this.inputControl.setValue(this.inputControl.value.slice(0, -1));
    }
    /**
     * If you want to handle the shift and caps lock buttons
     */
    if (button === '{shift}') { this.handleShift(); }
    if (button === '{lock}') { this.handleCaps(); }
  }

  onInputChange = (event: any) => {
    this.keyboard.setInput(event.target.value);
  }

  handleShift = () => {
    const currentLayout = this.keyboard.options.layoutName;
    const shiftToggle = currentLayout === 'default' ? 'shift' : 'default';

    this.keyboard.setOptions({
      layoutName: shiftToggle
    });
  }

  handleCaps = () => {
    const currentLayout = this.keyboard.options.layoutName;
    const shiftToggle = currentLayout === 'default' ? 'caps' : 'default';

    this.keyboard.setOptions({
      layoutName: shiftToggle
    });
  }

}
