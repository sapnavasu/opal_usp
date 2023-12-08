import { Injectable,Output,EventEmitter } from '@angular/core';
import { notes } from '../notes models/notes.interface';
@Injectable({
    providedIn: 'root'
  })
  export class NotesService {
   @Output() addList:EventEmitter<any> = new EventEmitter();
   @Output() getnotes:EventEmitter<notes> = new EventEmitter();
    constructor(){}

  sendData(value){
      this.addList.emit(value);
  }

  sendNotesInfoEdit(value){
    this.getnotes.emit(value);
}
}