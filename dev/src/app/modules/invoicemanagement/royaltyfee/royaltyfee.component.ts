import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA, MatDialog } from "@angular/material/dialog";
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { ToastrService } from "ngx-toastr";
import swal from "sweetalert";
import { MatTableDataSource } from '@angular/material/table';
import { FormControl } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatTabGroup } from '@angular/material/tabs';
@Component({
  selector: 'app-royaltyfee',
  templateUrl: './royaltyfee.component.html',
  styleUrls: ['./royaltyfee.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class RoyaltyfeeComponent implements OnInit {

  public mattab: any = 0;
  public pageloader;


  @ViewChild('MatTabGroup') tabGroup: MatTabGroup;
  matTabs: string;

  constructor(private translate: TranslateService,
    private remoteService: RemoteService, public toastr: ToastrService,
    private cookieService: CookieService,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }];
  dir = "ltr";
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
    });

    console.log(localStorage.getItem("tab-switch"),'localStorage.getItem("tab-switch")');
    if (localStorage.getItem("tab-switch") == "Technical Inspection Centre") {
      this.mattab = 1;
      localStorage.setItem("tab-switch", "");
    }

    if (localStorage.getItem("tab-switch") == "Technical Installaion Centre") {
      this.mattab = 2;
      localStorage.setItem("tab-switch", "");
    }
    
    this.valueGet();
  }
  valueGet() {
    const storedValue = localStorage.getItem('matTab');
    if(storedValue == 'techTab') {
      this.mattab = 1;
      localStorage.removeItem('matTab');
    }else if(storedValue == 'ivmsTab') {
      this.mattab = 2;
      localStorage.removeItem('matTab');
    }
  }
}
