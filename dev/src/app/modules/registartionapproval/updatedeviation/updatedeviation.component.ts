import { Component, OnInit, Input } from '@angular/core';
import swal from 'sweetalert';
import { FormGroup, FormBuilder, Validators, FormControl } from '@angular/forms';
import { Observable } from 'rxjs';
import {map, startWith} from 'rxjs/operators';
import {ViewEncapsulation } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import { ErrorStateMatcher } from '@angular/material/core';
import { CookieService } from 'ngx-cookie-service';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-updatedeviation',
  templateUrl: './updatedeviation.component.html',
  styleUrls: ['./updatedeviation.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class UpdatedeviationComponent implements OnInit {
  i18n(key){
		return this.translate.instant(key);
	  }
  myControl = new FormControl();
  updateoption: string[] = [
  "Create a new dimension with Smart List selected as the Dimension Type",
  "Create members in the dimension. (The members are the items that display in the drop-down, data form, or grid.)",
  "Some examples of approved comments & declined comment available",
  "Assign properties to the Smart List dimension and members. Assign a Label to the Smart List and Smart List members.",
  "Enable Smart Lists for data forms. See the Oracle Hyperion Planning Administrator's Guide.",
  "Use Smart List values in member formulas and business rules.",
];
updateOptions: Observable<string[]>;
  animationState2 = 'out';
  @Input('updatedeviationdrawer') updatedeviationdrawer: MatDrawer;
  public buttonname: string = 'Update';
  public UpdatedeviationForm: FormGroup;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  constructor(private fb: FormBuilder,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,) { }

  languagelist = [{"id":"1","languageName":"English","languagecode":"en","CountryMst_Pk":"136","dir":"ltr"},
  {"id":"2","languageName":"Arabic","languagecode":"ar","CountryMst_Pk":"31","dir":"rtl"}];
  dir="ltr" 

  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode')); 
   if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
       this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
	  
      });
    this.UpdatedeviationForm = this.fb.group({
      pipedriverref:["",Validators.required],
      comments:["",Validators.required],
    });
    this.updateOptions = this.myControl.valueChanges.pipe(
      startWith(''),
      map(value => this._filter(value))
    );
  }

   private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();

    return this.updateoption.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
  }

  Updatepaymentalert() {
    swal({
      title: this.i18n('updatedeviation.doyouwanttocancupda'),
      text: this.i18n('updatedeviation.areyousureyouwantcanbc'),
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: [this.i18n('updatedeviation.canc'), this.i18n('updatedeviation.okbutton')],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.updatedeviationdrawer.toggle();
      }
    });
    this.animationState2 = 'out';
  }
}
