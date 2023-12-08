import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { Filee } from '@app/@shared/filee/filee';
import { DriveInput } from '@app/common/classes/driveInput';
import { TranslateService } from '@ngx-translate/core';
import { IvmsdeviceService } from '@app/services/ivmsdev.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-ivms-import-view',
  templateUrl: './ivms-import-view.component.html',
  styleUrls: ['./ivms-import-view.component.scss']
})
export class IvmsImportViewComponent implements OnInit {
  acknowledgeform: FormGroup;
  deleteicon : boolean = true;
  @ViewChild(Filee) filee:Filee;
  @ViewChild('temporary') temporary: Filee;
  @ViewChild('newsDoc') newsDoc:Filee;
  sampleurl: any;
  PageLoaders: boolean;
  file: any;
  totalrecord: any;
  uploadsuccesss: any;
  uploadfailures: any;
  errors: any;
  displaycounts: boolean;
  successRow: any;
  totalRow: any;
  failureRow: any;
  successrows: any;
  showresult: boolean = false;
  showresultheader: boolean = false;
  enablemaxsize: boolean;
  maxscreen: boolean;
  hideall: boolean =true;
  i18n(key) {
    return this.translate.instant(key);
  }
  displayedColumns = [
    { def: "failure_comment", visible: true, disabled: true },
    { def: "vichle_reg", visible: true, disabled: false },
    { def: "chasis_number", visible: true, disabled: true },
    { def: "ivms_device", visible: true, disabled: false },
    { def: "dateofexp", visible: true, disabled: false },
  ];

  constructor(
    public router: Router,
    private translate: TranslateService,
    private fb: FormBuilder,
    private ivmsService:IvmsdeviceService,
    private toastr:ToastrService
  ) { }
  public drvInput:DriveInput;


  ngOnInit(): void {
    this.errors = null;
    this.displaycounts= false;
    this.showresult= false;
    this.initialise();
  }

  initialise()
  {
    this.drvInput = {
      fileMstPk:23,
      selectedFilesPk:[] 
    };
    this.acknowledgeform = this.fb.group({
      reportdocument: ["", Validators.required],
    });

    this.PageLoaders = true;
    this.ivmsService.getsamplefileurl().subscribe((response) => {
      this.sampleurl = response.data.templateurl;
      this.PageLoaders = false;
    });

    
  }

  enablemaxscreen() {
    this.enablemaxsize = true;
    this.maxscreen = true;
    this.hideall = false;
  }
  disablemaxscreen() {
    this.enablemaxsize = false;
    this.maxscreen = false;
    this.hideall = true;
  }

  async fileeSelected(files, fileId) {
    this.showresult = false;
    this.file = files[0];
    this.PageLoaders = true;
    this.displaycounts = false;
    if(this.file)
    {
      this.ivmsService.ExcelIvmsImportValidate(this.file).subscribe((response) => {
        let formatedError = "";
        this.PageLoaders = false;
        if (response.success == false && response.status == 500) {
          this.toastr.error('File doesn\'t Exist', 'Error !', {
            timeOut: 3000,
          });
        }
        else
        {

          if (response.data.templdatestatus) {
            this.showresult = true;
            this.displaycounts = true;
            this.successRow = response.data.success;
            this.failureRow = response.data.failed;
            this.totalRow = response.data.total;
            this.totalrecord = response.data.total;
            this.uploadsuccesss = response.data.success;
            this.uploadfailures = response.data.failed;
            // document.getElementById("totalrecords").innerHTML = response.data.total;
            // document.getElementById("uploadsuccess").innerHTML = response.data.success;
            // document.getElementById("uploadfailure").innerHTML = response.data.failed;
            this.errors = response.data.errorarray;

            console.log(this.errors)
            this.successrows = response.data.successarray;
            
            document.getElementById("resultview").style.display = "block";
            if (this.errors.length > 0) {
              
              
              this.showresultheader = true;
              formatedError = formatedError.concat(`<table>`);
                formatedError = formatedError.concat(`
                <tr>
                
                    <th>Error Message</th>
                    <th>CR No.</th>
                    <th>Centre Name</th>
                    <th>Office Type</th>
                    <th>Branch Name</th>
                    <th>Device IMEI number</th>
                    <th>Device Model</th>
                    <th>Software</th>
                    <th>Customer name (Client)</th>
                    <th>Vehicle Manufacturer</th>
                    <th>Vehicle Category</th>
                    <th>Vehicle Reg. No.</th>
                    <th>Chassis No.</th>
                    <th>Date of fitting</th>
                    <th>Date of replacement, if any</th>
                    
                </tr>`);
              this.errors.forEach((error) => {
                console.log(error)
              
                  formatedError = formatedError.concat(`
                <tr>
                  <td class="fontred">${error.Over_all_Comments}</td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['CR No.'] ? "bgred" : ""}"><span>${error['CR No.']  ? error['CR No.']  : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Company Name'] ? "bgred" : ""}"><span>${error['Centre Name'] ? error['Centre Name'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Office Type'] ? "bgred" : ""}"><span>${error['Office Type'] ? error['Office Type'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Branch Name'] ? "bgred" : ""}"><span>${error['Branch Name'] ? error['Branch Name'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Device IMEI number'] ? "bgred" : ""}"><span>${error['Device IMEI number'] ? error['Device IMEI number'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Device Model'] ? "bgred" : ""}"><span>${error['Device Model'] ? error['Device Model'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Software'] ? "bgred" : ""}"><span>${error['Software'] ? error['Software'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Customer name (Client)'] ? "bgred" : ""}"><span>${error['Customer name (Client)'] ? error['Customer name (Client)'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Vehicle Manufacturer'] ? "bgred" : ""}"><span>${error['Vehicle Manufacturer'] ? error['Vehicle Manufacturer'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Vehicle Category'] ? "bgred" : ""}"><span>${error['Vehicle Category'] ? error['Vehicle Category'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Vehicle Reg. No.'] ? "bgred" : ""}"><span>${error['Vehicle Reg. No.'] ? error['Vehicle Reg. No.'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Chassis No.'] ? "bgred" : ""}"><span>${error['Chassis No.'] ? error['Chassis No.'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Date of fitting'] ? "bgred" : ""}"><span>${error['Date of fitting'] ? error['Date of fitting'] : "-"}</span></td>
                  <td class="${error.pq_cellattr && error.pq_cellattr['Date of replacement, if any'] ? "bgred" : ""}"><span>${error['Date of replacement, if any'] ? error['Date of replacement, if any'] : "-"}</span></td>
                  
                  </tr>`);

              });

              formatedError.concat(`</table>`);

            } else {
              formatedError = formatedError.concat(`<p class="successmsg">All Records Uploaded Successfully</p>`);
              this.showresultheader = false;
            }

            document.getElementById("result-id").innerHTML = formatedError;
          }
          else {
            this.toastr.warning("Please Upload a Valid Excel File.", 'Invalid Template Imported !!!', {
              timeOut: 3000,
            });
          }
        }
        // console.log(response)
        // this.displaycounts = true;
  
        // document.getElementById("totalrecords").innerHTML = response.data.total;
        // document.getElementById("uploadsuccess").innerHTML = response.data.success;
        // document.getElementById("uploadfailure").innerHTML = response.data.failed;
  
        // this.errors = response.data.errorarray;
        // if (this.errors) {
        //   // this.exportToCSV();
        //   this.displaycounts = true;
        // }
      });
    }
    
  }

   uploadanother() {
    this.sampleurl = null;
    this.file = null;
    this.drvInput.selectedFilesPk = [];
    this.errors = null;
    this.displaycounts= false;
    this.showresult= false;
    this.temporary.triggerChange();
     this.initialise();
  }

  getdisplayedColumn(): string[] {
    return this.displayedColumns.filter(cd => cd.visible).map(cd => cd.def);
  }

  close()
  {
    this.router.navigate(['/manageivms/ivmslist']);
  }

  exportToCSV() {

    if (this.errors.length > 0) {
      console.log(this.errors[-1]);


      var csv = 'Error Message,CR No.,Centre Name,Office Type,Branch Name,Device IMEI number,Device Model,Software,Customer name (Client),Vehicle Manufacturer,Vehicle Category,Vehicle Reg. No.,Chassis No.,Date of fitting,Date of replacement\n';

      this.errors.forEach(function (error) {
        csv += "\"" + (error.Over_all_Comments ? error['Over_all_Comments'] : '-') +  "\",";
        csv += "\"" + (error['CR No.'] ? error['CR No.'] : '-' ) + "\",";
        csv += "\"" + (error['Centre Name'] ? error['Centre Name'] : '-') + "\",";
        csv += "\"" + (error['Office Type'] ? error['Office Type'] : '-') + "\",";
        csv += "\"" + (error['Branch Name'] ? error['Branch Name'] : '-') + "\",";
        csv += "\"" + (error['Device IMEI number']  ? error['Device IMEI number'] : '-')+ "\",";
        csv += "\"" + (error['Device Model']  ? error['Device Model'] : '-') + "\",";
        csv += "\"" + (error['Software'] ? error['Software'] : '-' )+ "\",";
        csv += "\"" + (error['Customer name (Client)'] ? error['Customer name (Client)'] : '-') + "\",";
        csv += "\"" + (error['Vehicle Manufacturer'] ? error['Vehicle Manufacturer'] : '-') + "\",";
        csv += "\"" + (error['Vehicle Category'] ? error['Vehicle Category'] : '-') + "\",";
        csv += "\"" + (error['Vehicle Reg. No.'] ? error['Vehicle Reg. No.'] : '-') + "\",";
        csv += "\"" + (error['Chassis No.'] ? error['Chassis No.'] : '-')+ "\",";
        csv += "\"" + (error['Date of fitting'] ? error['Date of fitting'] : '-') + "\",";
        csv += "\"" + (error['Date of replacement, if any'] ? error['Date of replacement, if any'] : '-') + "\",";
        csv += "\n";
      });


      var hiddenElement: any = document.createElement('a');
      let d = new Date();
      var name = d.getTime()
      hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
      hiddenElement.target = '_blank';
      //provide the name for the CSV file to be downloaded
      hiddenElement.download = 'IVMS_Import_Error_Log' + name + '.csv';
      hiddenElement.click();
    }
  }

 

}

