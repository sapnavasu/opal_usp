import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-ivms-view',
  templateUrl: './ivms-view.component.html',
  styleUrls: ['./ivms-view.component.scss']
})
export class IvmsViewComponent implements OnInit {
  acknowledgeform: FormGroup;
  @ViewChild(Filee) filee:Filee;
  @ViewChild('newsDoc') newsDoc:Filee;
  i18n(key) {
    return this.translate.instant(key);
  }

  constructor(
    public router: Router,
    private translate: TranslateService,
    private fb: FormBuilder,
  ) { }
  public drvInput:DriveInput;


  ngOnInit(): void {
    this.drvInput = {
      fileMstPk:81,
      selectedFilesPk:[] 
    };
    this.acknowledgeform = this.fb.group({
      reportdocument: ["", Validators.required],
    });
  }

  fileeSelected(file, fileId) {
    // fileId.selectedFilesPk = file;
  }

}
