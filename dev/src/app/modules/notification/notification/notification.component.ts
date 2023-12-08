import { Component, OnInit,ViewEncapsulation, ViewChild } from '@angular/core';
import { environment } from '@env/environment';
import { NotificationService } from '@app/modules/notification/notification/notification.service';
import { combineAll } from 'rxjs-compat/operator/combineAll';
import { findIndex } from 'rxjs-compat/operator/findIndex';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { FormControl, FormGroup, Validators } from '@angular/forms';
export interface Eachrnoticelist {  
  title:string;
  date:string;
  time:string;
  para1:string;
  para2:string;
  checked:any;
}
@Component({
  selector: 'app-notification',
  templateUrl: './notification.component.html',
  styleUrls: ['./notification.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class NotificationComponent implements OnInit {
  panelOpenState = false;
  tabnotice:boolean=true;
  tabbroad:boolean=false;
  tabadvisory:boolean=false;
  tabcontract:boolean=false;
  tabbid:boolean=false;
  noticetrash:boolean=false;
  broadtrash:boolean=false;
  advisorytrash:boolean=false;
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
  checkall:boolean = false;
  // readtoogle:boolean = false;
  // filternotice:string = '';
  category_trash = 1;
  public page = 0;
  public perpage = 10;
  public resultsnoticeLength = 0;
  public resultsawardLength = 0;
  public resultsLength = 0;
  public datafor='notice';
  public cleardata = false;
  @ViewChild(MatPaginator) paginator: MatPaginator;
    isOverflowing(el) {
      return (el.offsetWidth < el.scrollWidth);
    }
  constructor(private noticeservice: NotificationService) { }
  filterform = new FormGroup({
    searchbytitle: new FormControl(''),
    sorting: new FormControl(''),
    unreadmsg: new FormControl('')
  });
  // noticelist: Eachrnoticelist[];
  allnoticelist: Eachrnoticelist[] = [];
  allnoticelistfilter: Eachrnoticelist[];
  trashnoticelist: Eachrnoticelist[] = [];
  unreadflag:boolean = false;
  // noticelist = []
  notification_title = 'Enquiries';
  ngOnInit() {
    // this.paginator.length = 0;  
    this.filterform.get('searchbytitle').valueChanges.debounceTime(500).subscribe(val => {
      this.noticedatas(); 
      });
    this.noticedatas();
  }
  // searchtitle(){
  //   // this.filterform.get('searchbytitle').valueChanges.debounceTime(500).subscribe(val => {
  //       this.noticedatas(); 
  //   // });
  // }
  noticePaginator(event: PageEvent) {
    this.noticedatas('pagination',event);
    this.paginator.pageIndex = event.pageIndex;
    // this.paginator.pageSize = event.pageSize;
    //this.paginator.page.emit(event);
  }

  
  
  noticetab(){   
    if(this.tabnotice){
      this.clear()
    }
    this.tabnotice=true;
    this.tabbroad=false;
    this.tabadvisory=false;
    this.tabcontract=false;
    this.tabbid=false;
    this.noticetrash=false;
    this.broadtrash=false;
    this.advisorytrash=false;
    this.notification_title = 'Enquiries';
    this.datafor = 'notice';
    // this.noticedatas(); 

  }
  broadtab(){
    if(!this.tabbroad){
      this.clear()
    }
    this.tabbroad=true;
    this.tabnotice=false;
    this.tabadvisory=false;
    this.tabcontract=false;
    this.tabbid=false;
    this.noticetrash=false;
    this.broadtrash=false;
    this.advisorytrash=false;
    // this.notification_title = 'Advisories'
  }
  advisorytab(){
    if(!this.tabadvisory){
      this.clear()
    }
    this.tabadvisory=true;
    this.tabbroad=false;
    this.tabnotice=false;
    this.tabcontract=false;
    this.tabbid=false;
    this.noticetrash=false;
    this.broadtrash=false;
    this.advisorytrash=false;
    this.notification_title = 'Advisories';
  }
  contracttab(){
    // if(!this.tabcontract){
    //   this.clear()
    // }
    this.tabcontract=false;
    this.tabadvisory=false;
    this.tabbroad=false;
    this.tabnotice=true;
    this.tabbid=false;
    this.noticetrash=false;
    this.broadtrash=false;
    this.advisorytrash=false;
    this.notification_title = 'Awards';
    this.datafor = 'awards';
    this.noticedatas();
  }
  bidtab(){
    if(!this.tabbid){
      this.clear()
    }
    this.tabbid=true;
    this.tabcontract=false;
    this.tabadvisory=false;
    this.tabbroad=false;
    this.tabnotice=false;
    this.noticetrash=false;
    this.broadtrash=false;
    this.advisorytrash=false;
    this.notification_title = 'eBid';
  }
  tashnotice(){
    if(!this.noticetrash){
      this.clear()
    }
    this.tabbid=false;
    this.tabcontract=false;
    this.tabadvisory=false;
    this.tabbroad=false;
    this.tabnotice=true;
    this.noticetrash=false;
    this.broadtrash=false;
    this.advisorytrash=false;
    this.notification_title = 'Enquiries'
    this.datafor = 'trashnotice';
    this.noticedatas();
  }
  tashbroad(){
    if(!this.broadtrash){
      this.clear()
    }
    this.tabbid=false;
    this.tabcontract=false;
    this.tabadvisory=false;
    this.tabbroad=false;
    this.tabnotice=false;
    this.noticetrash=false;
    this.broadtrash=true;
    this.advisorytrash=false;
  }
  tashadvisory(){
    // if(!this.advisorytrash){
    //   this.clear()
    // }
    this.tabbid=false;
    this.tabcontract=false;
    this.tabadvisory=false;
    this.tabbroad=false;
    this.tabnotice=false;
    this.noticetrash=true;
    this.broadtrash=false;
    this.advisorytrash=false;
    this.notification_title = 'Awards';
    this.datafor = 'trashawards';
    // this.noticedatas();
  }
  noticelist: Eachrnoticelist[] = [
    {   
      title:"Received a New RFQ [Ref. No ?] ",date:"21-01-2020",time:"19:00(GMT+4)",para1:"You have received a RFQ from [Ref. No - title ?]. Kindly respond to the RFQ on or before (d-m-Y) 01-05-2022 11:46 AM(UTC-10:00).",para2:"Daleel",checked:false
    },{   
      title:"Received an Updated RFQ [Ref. No here ?]",date:"21-01-2020",time:"19:00(GMT+4)",para1:"You have received an updated Request for Quotation (RFQ) from [Ref. No - title ?]. Kindly respond to the RFQ on or before (d-m-Y) 01-05-2022 11:46 AM(UTC-10:00).",para2:"Daleel",checked:false
    },
    {   
      title:"Respond to RFQ [Ref. No here ?]",date:"21-01-2020",time:"19:00(GMT+4)",para1:"Reminder to respond to the received Request for Quotation (RFQ) from [Ref. No - title ?]. Kindly respond to the RFQ on or before (d-m-Y) 01-05-2022 11:46 AM(UTC-10:00).",para2:"Daleel",checked:false
    },
    {   
      title:"Received a New RFQ [Ref. No here ?]",date:"21-01-2020",time:"19:00(GMT+4)",para1:"You have received a Request for Quotation (RFQ) from [Ref. No - title ?]. Kindly respond to the RFQ on or before (d-m-Y) 01-05-2022 11:46 AM(UTC-10:00).",para2:"Daleel",checked:false
    },
    {   
      title:"RFQ [Ref. No here ?] has been Terminated.",date:"21-01-2020",time:"19:00(GMT+4)",para1:"PDO has terminated the Request for Quotation (RFQ) from [Ref. No - title ?]",para2:"Daleel",checked:false
    },
      {   
        title:"This is the primary content of the panel",date:"21-01-2020",time:"19:00(GMT+4)",para1:"Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks.With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine.Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",para2:"Business Gateways International (I) Private Limited",checked:false
      },
      {   
        title:"Reviewing Existing Documentation",date:"20-01-2020",time:"20:00(GMT+4)",para1:"Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks.With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine.Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",para2:"Business Gateways International (I) Private Limited",checked:false
      },
      {   
        title:"Sample Privacy Policy Template - Terms-Feed",date:"22-01-2020",time:"06:00(GMT+4)",para1:"Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks.With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine.Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",para2:"Business Gateways International (I) Private Limited",checked:false
      }
];
public scrollTo(className: string): void {
  try {
      const elementList = document.querySelectorAll('.' + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: 'smooth'});
  } catch (error) {
      console.log('page-content')
      }
  }
  noticedatas(init?,event?){
    if(init=="pagination") {
      this.perpage = event.pageSize;
      this.page = parseInt(event.pageIndex) + 1;
    } 
    this.noticeservice.getnotification(this.datafor,this.filterform.value,this.perpage,this.page).subscribe(data => {
      this.setnoticevalue(data);
    });
  }
  filterunread(){
    this.unreadflag = !this.unreadflag;
    this.filterform.patchValue({
      unreadmsg:this.unreadflag
    });
    this.noticedatas();
  }
  updatenotification(upaction:string){
    var notificationIds = [];
    if(upaction=='unread'){
      this.noticeservice.updatenotification(notificationIds,1,this.datafor,this.filterform.value,this.perpage,this.page).subscribe(data => {
        this.setnoticevalue(data);
      });
    }else{
      this.allnoticelistfilter.forEach((val,key)=>{
        if(typeof(val['checked']) != "string"&&val['checked']){
          notificationIds.push(val['bcastnotifdtls_pk'])
        }
      })
      if(notificationIds.length>0){
        if(upaction=='read'){
          this.noticeservice.updatenotification(notificationIds,2,this.datafor,this.filterform.value,this.perpage,this.page).subscribe(data => {
            this.setnoticevalue(data);
          });
        }else if(upaction=='delete'){
          this.noticeservice.updatenotification(notificationIds,3,this.datafor,this.filterform.value,this.perpage,this.page).subscribe(data => {
            this.setnoticevalue(data);
      
          });
        }
      }
    }
  }
  setnoticevalue(data:any){
    this.resultsnoticeLength = data['data']['total_notice_data'];
    this.resultsawardLength = data['data']['total_award_data'];
    if(this.datafor=='notice'||this.datafor=='trashnotice'){
      this.paginator.length=data['data']['total_notice_data'];
      this.resultsLength = data['data']['total_notice_data'];
    }else if(this.datafor=='awards'||this.datafor=='trashawards'){
      this.paginator.length=data['data']['total_award_data'];
      this.resultsLength = data['data']['total_award_data'];
    }
    
    this.allnoticelist = data['data']['notice_data'];
    
    this.allnoticelistfilter = this.allnoticelist;
    this.checkall = false;
   
  }
  
  sortnotification(srttype:string){
    this.filterform.patchValue({
      sorting:srttype
    });
    this.noticedatas();
  }
  castconversion(ischecked:any){
    return (typeof(ischecked) != "string"&&ischecked) ? true : false;
  }
  
  check_uncheckall(){
    for(var i=0;i<this.allnoticelistfilter.length;i++){
      this.allnoticelistfilter[i].checked = this.checkall;
    }
  }
  isSelected(){
    this.checkall = this.allnoticelistfilter.every(function(notification_rec:any){
      return notification_rec.checked == true;
    })
    
  }
  clear(){
    this.allnoticelistfilter = [];
    this.allnoticelist = [];
    this.unreadflag = false;
    this.checkall = false;
    this.check_uncheckall()
    this.page = 0;
    // this.cleardata = true;
    // this.filterform.patchValue({
    //   searchbytitle:''
    // });
    this.filterform.reset();
    // this.filternotice = '';
  }
  tabidentify(tabindex:any){
    this.category_trash = (tabindex.index==0) ? 1 : 2;
    this.resultsnoticeLength = 0;
    this.resultsawardLength = 0;
    this.resultsLength = 0;
    this.paginator.pageIndex = 0;
    if(this.category_trash==1){
      this.noticetab();
    }else{
      this.tashnotice();
    }
  }
  statustoRead(noifypk:string,index:any){
    var notificationIds = [noifypk];
    if(this.allnoticelistfilter[index]['bnd_status']==1){
      document.querySelectorAll('.removbold' + index)[0].classList.remove('fw-bold');
      this.noticeservice.updatenotification(notificationIds,2,this.datafor,this.filterform.value,this.perpage,this.page).subscribe(data => {
     
      });
    }
  }
  messagecontent(notice:any){
    if(notice.bnm_isdeleted==1||notice.bnm_msgtype!=3){
      return notice.para1;
    }else{
      return notice.para1+' '+(notice.bnm_closing_date)+'.';
    }
  }
}
