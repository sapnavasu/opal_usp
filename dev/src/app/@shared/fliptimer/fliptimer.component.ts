import { AfterViewInit, Component, NgZone, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-fliptimer',
  templateUrl: './fliptimer.component.html',
  styleUrls: ['./fliptimer.component.scss']
})
export class FliptimerComponent  implements AfterViewInit {

  currentDate: any;
  targetDate: any;
  cDateMillisecs: any;
  tDateMillisecs: any;
  difference: any;
  seconds: any = '00';
  minutes: any = '00';
  hours: any = '00';
  days: any = '00';
  year:number = 2021;
  month:number = 11;
  months = ['Jan', 'Feb', 'Mar', 'April', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
  day:number = 31;
  flag = true;
  timer:any;
  
  @Input('timerDate') timerDate: any;
  @Output() timeOver = new EventEmitter<any>();

  constructor(private zone:NgZone){
    
  }
  ngAfterViewInit() {
    if(this.flag){
      this.flag = false;
      this.timer = setInterval(()=>this.myTimer(), 1000);
    }
  }

  myTimer() {
    if(this.timerDate) {
      this.currentDate = new Date();
      this.targetDate = new Date(this.timerDate);
      this.cDateMillisecs = this.currentDate.getTime();
      this.tDateMillisecs = this.targetDate.getTime();
      this.difference = this.tDateMillisecs - this.cDateMillisecs;
      
      if(this.difference > 0) {
        this.seconds = Math.floor(this.difference / 1000);
        this.minutes = Math.floor(this.seconds / 60);
        this.hours = Math.floor(this.minutes / 60);
        this.days = Math.floor(this.hours / 24);
    
        this.hours %= 24;
        this.minutes %= 60;
        this.seconds %= 60;
        this.hours = this.hours < 10 ? "0" + this.hours : this.hours;
        this.minutes = this.minutes < 10 ? "0" + this.minutes : this.minutes;
        this.seconds = this.seconds < 10 ? "0" + this.seconds : this.seconds;
        // this.timeOver.emit(false);
      } else {
        clearInterval(this.timer);
        this.timeOver.emit(true);
      }
    }
  }

  ngOnDestroy(){
    clearInterval(this.timer);
  }    
}
