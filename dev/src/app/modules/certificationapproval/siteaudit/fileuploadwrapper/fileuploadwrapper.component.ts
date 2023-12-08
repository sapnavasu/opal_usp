import { Component, OnInit, Input } from '@angular/core';
import { DriveInput } from '@app/common/classes/driveInput';
import { FormControl, FormGroup, ControlContainer } from '@angular/forms';

@Component({
  selector: 'app-fileuploadwrapper',
  templateUrl: './fileuploadwrapper.component.html',
  styleUrls: ['./fileuploadwrapper.component.scss']
})
export class FileuploadwrapperComponent implements OnInit {
  public form: FormGroup;
  public control : FormControl;
  drvInputed: DriveInput;
  @Input() formControlId: any;
  @Input() filesSelected: () => void;
  @Input() drvInputFromParent: DriveInput;
  @Input() deleteicon: any;

  constructor(private controlContainer: ControlContainer) { }

  ngOnInit(): void {
    console.log('fileselected', this.filesSelected)
    this.form = <FormGroup>this.controlContainer.control;
    this.control = <FormControl>this.form.get(`file_${this.formControlId}`);
    this.drvInputed = this.drvInputFromParent && this.drvInputFromParent[this.formControlId] ? this.drvInputFromParent[this.formControlId] : {
      fileMstPk: 2,
      selectedFilesPk: []
    };
  }

}
