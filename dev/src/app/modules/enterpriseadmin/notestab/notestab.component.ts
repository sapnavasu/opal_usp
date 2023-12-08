import { Component, Inject, OnInit, ViewChild } from "@angular/core";
import {COMMA, ENTER} from '@angular/cdk/keycodes';
import { MatChipInputEvent } from "@angular/material/chips";
import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from "@angular/material/dialog";
import { FormBuilder, FormControl, FormGroup, Validators } from "@angular/forms";
import { Addpeople, notes } from "./notes models/notes.interface";
import { NotesService } from "./services/notes.services";
import { Filee } from '@app/@shared/filee/filee';
import { Encrypt } from '@app/common/class/encrypt';
import { DriveInput } from '@app/common/classes/driveInput';
import * as _moment from 'moment';
import { default as _rollupMoment } from 'moment';
import { SelectionModel } from "@angular/cdk/collections";
import { SlideInOutAnimation } from '@app/@shared/animation/animation';

const moment = _rollupMoment || _moment;

export interface DialogData {
  animal: string;
  name: string;
}
interface Notifying {
  value: string;
  viewValue: string;
}
export interface Notespanelsinfo {
  titleinfo: string;
  notedate: string;
  notetime: string;
  itemtitle: string;
  notedesc: string;
}
export interface LocaleConfig {
  direction?: string;
  separator?: string;
  weekLabel?: string;
  applyLabel?: string;
  cancelLabel?: string;
  clearLabel?: string;
  customRangeLabel?: string;
  daysOfWeek?: string[];
  monthNames?:  string[];
  firstDay?: number;
  format?: string;
  displayFormat?: string;
}
@Component({
  selector: 'app-notestab',
  templateUrl: './notestab.component.html',
  styleUrls: ['./notestab.component.scss'],
  animations: [SlideInOutAnimation],
})
export class NotestabComponent implements OnInit {
  public dateFilter: FormControl = new FormControl();
  
  public dateFilterSt:any = '';
  public dateFilterEd:any = '';
  
  locale: LocaleConfig = {
    customRangeLabel: ' - ',
    separator: ' to ',
    applyLabel: 'Apply',
    cancelLabel: 'Cancel',
    clearLabel: 'Clear',
    format:'DD-MM-YYYY',
    daysOfWeek: moment.weekdaysMin(),
    monthNames: moment.monthsShort(),
    firstDay: moment.localeData().firstDayOfWeek(),
  }
  notespanellist: notes[] = [
    {
      notesid:0,
      titleinfo: "Review existing privacy documents...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'My Notes',
      notifytime:'15 minutes',
      time:"Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:1,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:false,
      date: "Thu May 15 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'My Notes',
      time: "Thu May 16 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:2,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'My Notes',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:3,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Deleted',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:4,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Shared',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:5,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Pinned Notes',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:6,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Pinned Notes',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:7,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Pinned Notes',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:8,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Deleted',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:9,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Deleted',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:10,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Shared',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:11,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Archived',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    },
    {
      notesid:12,
      titleinfo: "Remind that EBA negotiations are to commerce...",
      external:[{'name':'text'},{'name':'test'}],
      internal:[{'name':'text'},{'name':'test'}],
      notifytime:'15 minutes',
      allTime:true,
      date: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      archiveStatus:'Archived',
      time: "Thu May 13 2021 21:40:00 GMT+0530 (India Standard Time)",
      title:
        "Remind that EBA negotiations are to commerce group of 75 countries announced its decision on Friday to launch negotiations",
      description:
        "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app. When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks. With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine. Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
    }

  ];
  actionArray:number[]=[];
  filteredList:notes[]=[];
  selected:any;
  animationState1 = 'out';
  public keyText: any = 'Products (3)';
  public productlsit: any = 1;
  readonly separatorKeysCodes: number[] = [ENTER, COMMA];
  currentlySelected = 'My Notes';
  constructor(public dialog: MatDialog,private noteService:NotesService) {
    this.refreshData(this.currentlySelected)
  }
  change(){

  let list:notes[] = []
  if(this.selected && this.selected.startDate && this.selected.endDate){
    for(let i =0 ; i<this.filteredList.length;i++){
      let x = new Date(this.filteredList[i].date);
      if( x >= this.selected.startDate._d && x  <= this.selected.endDate._d){
          list.push(this.filteredList[i])
         
      }
    }
    this.filteredList = list;
  }else{this.refreshData(this.currentlySelected)}
   
  
  }
  ngOnInit() {
    this.noteService.addList.subscribe((data:any)=>{
      
      if(!data.allTime) { data.date =  new Date(data.date).setTime(data.time.getTime())}
        if(!data.edit){
          let a:notes;
          a = {notesid:this.notespanellist.length,allTime:data.allTime,date:data.date.toString(),notifytime:data.notifytime,selectedfilesPK:data.newsupload,
            archiveStatus:'My Notes',description:data.description,external:data.externalPeople,internal:data.peoplelist,time:data.date.toString(),title:data.title,titleinfo:data.title.split(' ').slice(0,2).join(' ')+'...'} ;
            this.notespanellist.push(a);}else{
              this.notespanellist[data.notesid].notifytime = data.notifytime;
              this.notespanellist[data.notesid].selectedfilesPK =  data.newsupload;
              this.notespanellist[data.notesid].description = data.description;
              this.notespanellist[data.notesid].external = data.externalPeople;
              this.notespanellist[data.notesid].internal = data.peoplelist;
              this.notespanellist[data.notesid].date = data.date.toString();
              this.notespanellist[data.notesid].time = data.date.toString();
              this.notespanellist[data.notesid].titleinfo = data.title.split(' ').slice(0,2).join(' ')+'...';
              this.notespanellist[data.notesid].title = data.title;
              this.notespanellist[data.notesid].allTime = data.allTime;
            }
           this.refreshData(this.currentlySelected);
        });
  }
  openDialog(): void {
    const dialogRef = this.dialog.open(Modalcreatenote, {
      width: "250px",
      panelClass: "addmembersinfo",
    });

    dialogRef.afterClosed().subscribe((result) => {
      console.log("The dialog was closed");
    });
  }

  refreshData(type = 'My Notes_all'){
    this.currentlySelected = type;
    if(type == 'My Notes' || type == 'Archived' || type == 'Deleted' || type == 'Shared' || type == 'Pinned Notes'){
      this.filteredList = this.notespanellist.filter((x:notes)=>x.archiveStatus == type);
    }else if('My Notes_all'){
      this.filteredList = this.notespanellist.filter((x:notes)=>x.archiveStatus == 'Shared' || x.archiveStatus == 'My Notes' || x.archiveStatus == 'Pinned Notes');
    }else if(type == 'Archived_all'){
      this.filteredList = this.notespanellist.filter((x:notes)=>x.archiveStatus == 'Deleted' || x.archiveStatus == 'Archived' );
    }
  }
  selecteAll(){
    this.actionArray = [];
    for(let i =0;i<this.filteredList.length;i++){
      if(this.notespanellist[this.filteredList[i].notesid].archiveStatus != 'Shared'){
      this.actionArray.push(this.filteredList[i]['notesid']);}
    }
  }
  toggleShowDiv(divName: string) {
    if (divName === 'aftersearchanimate') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
  }
  changeType(chText: any, searchKey: any) {
    this.keyText = chText;
    this.animationState1 = 'out';
    this.productlsit = searchKey;
  }
  checkArray(value){
    
    if(this.actionArray.find((x:any)=>x == value)){
      let index = this.actionArray.indexOf(value);
      if(index > -1){
        this.actionArray.splice(index,1);
        
      }
     }else{
       this.actionArray.push(value)
     }
    }
    action(type){
      
        for(let i = 0;i<this.actionArray.length;i++){
          if(this.notespanellist[this.actionArray[i]].archiveStatus != 'Shared'){
          this.setStatus(this.actionArray[i],type)}
        }
      
     
      this.actionArray=[];
    }
    
  checkif(id){
    
    if(this.actionArray.find((x:any)=>x == id) || this.actionArray.find((x:any)=>x == id) == 0){
      return true;
    }else{
      return false;
    }
  }
  refreshNumber(type = 'My Notes'){
      return this.notespanellist.filter((x:notes)=>x.archiveStatus == type).length;
  }
  setStatus(id,key){
    let set = this.notespanellist.find((x:any)=>x.notesid == id);
   
    set.archiveStatus = key;
    this.notespanellist[id] =set;
    this.refreshData(this.currentlySelected);
  }
  editNotes(id){
    this.openDialog();
    setTimeout(()=>{
      let edit:notes = this.notespanellist.find((x:any)=>x.notesid == id);
    this.noteService.sendNotesInfoEdit(edit);
    },1000 )
  }
}




@Component({
  selector: "modal-dialog",
  templateUrl: "modal-dialog.html",
  styleUrls: ["modal-dialog.scss"],
})
export class Modalcreatenote {
  visible = true;
  selectable = true;
  removable = true;
  addOnBlur = false;
  @ViewChild(Filee) filee: Filee;
  @ViewChild('newsDoc') newsDoc: Filee;
  public reqdocument: DriveInput;
  public drv_news: DriveInput;
  notifytime: Notifying[] = [
    {value: '1', viewValue: '15 Minutes'},
    {value: '2', viewValue: '30 Minutes'},
    {value: '3', viewValue: '45 Minutes'},
    {value: '4', viewValue: '60 Minutes'},
  ];

  readonly separatorKeysCodes: number[] = [ENTER, COMMA];
  peoplelist: Addpeople[] = [

  ];
  externalpeoplelist: Addpeople[] = [

  ];
  
  public notesform: FormGroup;
  submitted = false;
  edit = false;
  id:any;
  checked:boolean;
  constructor(private fb: FormBuilder,private notesService: NotesService,
    public dialogRef: MatDialogRef<Modalcreatenote>,
    @Inject(MAT_DIALOG_DATA) public data: DialogData
  ) {
    this.notesform = this.fb.group({
      notifytime:new FormControl(''),
      allTime:new FormControl(false),
      require:new FormControl(false),
      title: new FormControl('', Validators.compose([Validators.required])),
      date:new FormControl('',Validators.compose([Validators.required])),
      time: new FormControl(null),
      externalPeople:new FormControl(this.externalpeoplelist),
      newsupload:new FormControl(),
      peoplelist:new FormControl(this.peoplelist),
      description: new FormControl('', Validators.compose([Validators.required]))
    });
  }

  ngOnInit() {
    this.reqdocument = {
      fileMstPk: 105,
      selectedFilesPk: [], //Already inserted
    };
    this.notesService.getnotes.subscribe((data:notes)=>{
    data.selectedfilesPK ? this.reqdocument.selectedFilesPk = data.selectedfilesPK: this.reqdocument.selectedFilesPk=[];
      this.externalpeoplelist = data.external;
      this.peoplelist = data.internal;
      this.notesform.patchValue({
        newsupload:data.selectedfilesPK,
        notifytime:data.notifytime,
        allTime:data.allTime,
      title: data.title,
      date:new Date(data.date) ,
        time: data.allTime ? null : new Date(data.date),
       externalPeople: data.external,
       peoplelist: data.internal, 
      description: data.description
      });
      this.id = data.notesid;
     
      this.edit = true;
  });}

  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }
  submitNotes(value:any){
    value['edit']=this.edit;
    if(this.edit){value['notesid']=this.id;}
    if((value.time || value.allTime != false) && (value.externalPeople.length != 0 && value.peoplelist.length != 0) || !value.require){
      if(this.notesform.valid){
         this.notesService.sendData(value);
         this.onNoClick();
      }else{
                
        this.validateAllFormFields(this.notesform);
      }
    }
    this.submitted = true;
  }

  validateAllFormFields(formGroup: FormGroup) {
    Object.keys(formGroup.controls).forEach(field => {
      const control = formGroup.get(field);
      if (control instanceof FormControl) {
        control.markAsTouched({ onlySelf: true });
      } else if (control instanceof FormGroup) {
        this.validateAllFormFields(control);
      }
    });}

  onNoClick(): void {
    this.dialogRef.close();
  }

  addPeople(value){
    this.peoplelist.push({name:value});
  }
  
  add(event: MatChipInputEvent): void {
    const input = event.input;
    const value = event.value;

    // Add our fruit
    if ((value || '').trim()) {
      this.peoplelist.push({name: value.trim()});
    }

    // Reset the input value
    if (input) {
      input.value = '';
    }
  }

  remove(people: Addpeople): void {
    const index = this.peoplelist.indexOf(people);

    if (index >= 0) {
      this.peoplelist.splice(index, 1);
    }
  }

  addExternalPeople(value){
    this.externalpeoplelist.push({name:value});
  }
  
  addExternal(event: MatChipInputEvent): void {
    const input = event.input;
    const value = event.value;

    // Add our fruit
    if ((value || '').trim()) {
      this.externalpeoplelist.push({name: value.trim()});
    }

    // Reset the input value
    if (input) {
      input.value = '';
    }
  }

  removeExternal(people: Addpeople): void {
    const index = this.externalpeoplelist.indexOf(people);

    if (index >= 0) {
      this.externalpeoplelist.splice(index, 1);
    }
  }
  public scrollTo(className: string): void {
    try {
        const elementList = document.querySelectorAll('.' + className);
        const element = elementList[0] as HTMLElement;
        element.scrollIntoView({ behavior: 'smooth'});
    } catch (error) {
        console.log('page-content')
        }
    }
}


