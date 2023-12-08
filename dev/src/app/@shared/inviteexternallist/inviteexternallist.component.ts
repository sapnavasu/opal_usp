import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import swal from 'sweetalert';
import { ViewEncapsulation } from '@angular/core';
import { environment } from '@env/environment';
import { SlideInOutAnimation } from '@app/modules/profilemanagement/animation';
@Component({
  selector: 'app-inviteexternallist',
  templateUrl: './inviteexternallist.component.html',
  styleUrls: ['./inviteexternallist.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None,
})
export class InviteexternallistComponent implements OnInit {
  searchcountry=[
      {'value':1,'name':'Oman'},
      {'value':2,'name':'India'},
      {'value':3,'name':'Australia'}
    ];
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
  panel: number = 1;
  @Output() private sendList = new EventEmitter<any>();
  @Input() panelNo: number;
  externallists = [
    {contacttitle:'Sergio Agüro',contactsubtitle:"Marekting Manager",mobilenum:'+218 96787 332',contactemail:"Sergio@businessgateways.com"},
    {contacttitle:'Sergio Agüero',contactsubtitle:"Marekting Manager",mobilenum:'+218 96787 333',contactemail:"Sergio@businessgateways.com"},
    {contacttitle:'Sergio Agüero',contactsubtitle:"Marekting Manager",mobilenum:'+218 96787 334',contactemail:"Sergio@businessgateways.com"},

  ];

  financiallists = [
    {contacttitle:'Sergio Agüero',contactsubtitle:"Accounts Manager",mobilenum:'+218 96787 335',contactemail:"Sergio@businessgateways.com"},
    {contacttitle:'Sergio Agüero',contactsubtitle:"Sr. Accounts Manager",mobilenum:'+218 96787 336',contactemail:"Sergio@businessgateways.com"},
  ];

  extermemberlists  = [
    {extermembertitle:'Sergio Agüero',extermembersubtitle:"Marekting Manager",extermemnum:'+218 96787 332',extermememail:"Sergio@businessgateways.com",activate:"accepted"},
    {extermembertitle:'Zaim Qutaiba Masih',extermembersubtitle:"Marketing Executive",extermemnum:'+218 96787 332',extermememail:"Zaim@businessgateways.com",activate:"pending"},
  ];
  public buttonname: string = 'Invite';
  externalList:any[] = [];
  internalList:any[] = [];
  animationState = 'out';
  @Input('inviteexternallist') inviteexternallist: MatDrawer;
  constructor() { }

  ngOnInit(): void {
  }
  inviteexternalalert() {
    swal({
      title: "Do you want to cancel Inviting Members?",
      text: 'All the Data that you have entered will be lost.',
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.inviteexternallist.toggle();
      }
    });
    this.animationState = 'out';
  }
  addRem(value,type){
    if(type == 'External'){
      if(this.externalList.find(x=>x == value)){
        this.externalList = this.externalList.filter(x=>x != value)
      }else{
        this.externalList.push(value);
      }
    }else if(type == "Internal"){
      if(this.internalList.find(x=>x == value)){
        this.internalList = this.internalList.filter(x=>x != value)
      }else{
        this.internalList.push(value);
      }
    }
  }

  checkMembers(value,type){
    if(type == 'External'){
      if(this.externalList.find(x=>x == value)){
        return true;
      }else{
        return false;
      }
    }else if(type == "Internal"){
      if(this.internalList.find(x=>x == value)){
        return true;
      }else{
        return false;
      }
    }
  }
  OnSave(){
    this.sendList.emit({'external':this.externalList,'internal':this.internalList});
    this.inviteexternallist.toggle();
  }

  invitexternallistdropdown(divName: string) {
    if (divName === 'invitelistview') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }
  setOpen(i) {
    this.panel = i;
  }
}
