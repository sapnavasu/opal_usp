import { Component, Input, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { AccountsettingsService } from '../accountsettings.service';
import swal from 'sweetalert';
import { ToastrService } from 'ngx-toastr'
import { environment } from '@env/environment';
import { FormArray, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatDrawer } from '@angular/material/sidenav';
@Component({
  selector: 'app-emailpreferenceslist',
  templateUrl: './emailpreferenceslist.component.html',
  styleUrls: ['./emailpreferenceslist.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class EmailpreferenceslistComponent implements OnInit {
  searchOptions=[
      {'value':1,'name':'On'},
      {'value':2,'name':'Off'},
    ];
    public onOff = [];
  customCollapsedHeight: string = environment.customCollapsedHeight;
  customExpandedHeight: string = environment.customExpandedHeight;
  @Input() selectedEmailPref: any;
  public Emailprefform: FormGroup;
  public contractform: FormGroup;
  public scfform: FormGroup;
  @ViewChild('audittraillview') audittraillview: MatDrawer;
  ischeckedanother = true;
  panel: number = 1;
  companyprofiledata = [
    {profiletitle:"CR document to be displayed in the External Profile",profilesubtitlte:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",id:1},
    {profiletitle:"To be notified when user contacts from the external Profile",profilesubtitlte:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",id:2},
    {profiletitle:"To receive audit log on a weekly basis",profilesubtitlte:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",id:3},
    {profiletitle:"To receive an email on the newly registered users when they log in",profilesubtitlte:"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut diam dictum, euismod tellus vitae",id:4},
  ];
  public companyprofile:FormArray;


  // emailusers = [
  //   {id:1,name:"Rating reminders",title:"Send an email reminding me to rate an item a week after purchase"},
  //   {id:2,name:"Item update notifications",title:"Send an email when an item I've purchased is updated"},
  //   {id:3,name:"Item comment notifications",title:"Send me an email when someone comments on one of my items"},
  //   {id:4,name:"Team comment notifications",title:"Send me an email when someone comments on one of my team items"},
  //   {id:5,name:"Item review notifications",title:"Send me an email when my items are approved or rejected"},
  //   {id:6,name:"Buyer review notifications",title:"Send me an email when someone leaves a review with their rating"},
  //   {id:7,name:"Expiring support notifications",title:"Send me emails showing my soon to expire support entitlements"},
  //   {id:8,name:"Daily summary emails",title:"Send me a daily summary of all items approved or rejected"}, 
  // ];
  
  constructor(private accSettingService: AccountsettingsService,public toastr: ToastrService,private fb: FormBuilder,) { }

  ngOnInit() {
    this.onOff = [false];
    this.Emailprefform = this.fb.group({
      companyprofiledata: this.fb.array([])
    });
    this.contractform = this.fb.group({
      selectstatus:["",Validators.required],
      selectvaluestatus:["",Validators.required],
    });
    this.scfform = this.fb.group({
      selectmode:["",Validators.required],
      selectmodestatus:["",Validators.required],
    });
    this.companyprofile = this.Emailprefform.get('companyprofiledata') as FormArray;  
    this.companyprofiledata.forEach(val => {
      if(this.company(val.profiletitle, val.profilesubtitlte)) {
        this.companyprofile.push(this.company(val.profiletitle, val.profilesubtitlte)); 
      }
    });
    
  }
  company(title, subtile): FormGroup {
    return this.fb.group({
      profiletitle: title,
      profilesubtitlte: subtile,
      slide:[],
      selectmodevalue:["",Validators.required],
    });
  }

  getspecControls() {
    if (this.Emailprefform) {
      return (this.Emailprefform.get('companyprofiledata') as FormArray).controls;
    }
  }
  // employees(): FormArray {
  //   return this.Emailprefform.get('companyprofiledata') as FormArray;
  // }

  setslidevalue(i, value) {
    (<FormArray>this.Emailprefform.get('companyprofiledata')).at(i).get('slide').setValue(value);
  }
  
  setmodevalue(i, event) {
    (<FormArray>this.Emailprefform.get('companyprofiledata')).at(i).get('selectmodevalue').setValue(event.value);
  }

  submitform() {
  }
  showTSuccess(){
    this.toastr.success('Email preferences updated successfully.','Success !',{
        timeOut: 3000,
        closeButton: true,
    });
  }
  saveEmailPref(selectedList){
    if(selectedList.length > 0){
      let formatedEmailPref = this.formatEmailPref(selectedList);
      this.accSettingService.saveEmailPref(formatedEmailPref).subscribe(data => {
        this.showTSuccess();
      });
    }
  }

  formatEmailPref(selectedList: any){
    let returnVal = {};
    for(let i = 0; i < selectedList.length; i++){
      returnVal[selectedList[i].value] = "Yes";  
    }
    return returnVal;
  }

  setOpen(i) {
    this.panel = i;
  }

  public scrollTo(className: string): void {
    try {
        const elementList = document.querySelectorAll('.' + className);
        const element = elementList[0] as HTMLElement;
        element.scrollIntoView({ behavior: 'smooth'});
    } catch (error) {
        }
    }
}
