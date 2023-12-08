import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-documentstab',
  templateUrl: './documentstab.component.html',
  styleUrls: ['./documentstab.component.scss']
})
export class DocumentstabComponent implements OnInit {
  public rTitle:string;
  public rdescription:string;
  public rexten:string;
  constructor() { }
  fetchData = [
    {"title":"Personal Project.doc","size":"256 kb","exten":"doc","date":"dd"},
    {"title":"Estimated Budget.jpg","size":"1 mb","exten":"jpeg","date":"dd"},
    {"title":"Tender Document.pdf","size":"256 kb","exten":"pdf","date":"dd"},
    {"title":"Artical.docx","size":"256 kb","exten":"doc","date":"dd"},
    {"title":"Peoject.xls","size":"256 kb","exten":"xls","date":"dd"}];
  ngOnInit(): void {
    this.rTitle = 'Personal Project.doc';
    this.rdescription = '256 kb';
    this.rexten = 'doc'
  }
  selectdis(data){
    this.rTitle = data.title;
    this.rdescription = data.size;
    this.rexten = data.exten;
  }

}
