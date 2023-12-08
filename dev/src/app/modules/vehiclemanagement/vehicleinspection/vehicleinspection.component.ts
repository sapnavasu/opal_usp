import { Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { AbstractControl, FormArray, FormBuilder, FormControl, FormGroup, FormGroupDirective, ValidatorFn, Validators } from '@angular/forms';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import { DriveInput } from '@app/common/classes/driveInput';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import swal from 'sweetalert';
import { AppDateAdapter, APP_DATE_FORMATS } from '@app/@shared/format-datepicker';
import { ToastrService } from 'ngx-toastr';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
import { ActivatedRoute, ParamMap, Router } from '@angular/router';
import { ServiceVehiclemanagementService } from '../service-vehiclemanagement.service';
import { Encrypt } from '@app/common/class/encrypt';
import { Filee } from '@app/@shared/filee/filee';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatCheckbox } from '@angular/material/checkbox';


@Component({
  selector: 'app-vehicleinspection',
  templateUrl: './vehicleinspection.component.html',
  styleUrls: ['./vehicleinspection.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: AppDateAdapter },
    { provide: MAT_DATE_FORMATS, useValue: APP_DATE_FORMATS },
  ]
})
export class VehicleinspectionComponent implements OnInit {
  veiclepk: string;
  IsOffline: boolean;
  vehicleregstatus: any;
  InspectionTemplate: string = "Offline";
  checklist: any;
  arr: FormArray;
  dynamicSelect: any;
  ChekclistDocuments: any[];
  isEdit: boolean = false;
  EditDataValue: any;
  fileupload: any[] = [];
  fileuploadvalue: any;
  loader: boolean;
  stktype: any;
  isfocalpoint: any;
  useraccess: any;
  createaccess: boolean;
  readaccess: boolean;
  declineDtls: any = [];
  passanswrslist: any;
  allPassCheck: boolean = false;
  i18n(key) {
    return this.translate.instant(key);
  }
  public pageLoader: boolean = false;
  public ck = new InptLang_Ctrl();

  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public filtername = "Hide Filter";
  public approveDecline: FormGroup;
  public approvalstatus: boolean = true;
  public deleteicon: boolean = true;
  report: DriveInput;
  reportchklist: DriveInput;
  @ViewChild('assesmentrepot') assesmentrepot: Filee;
  @ViewChild('assesmentrepotre') assesmentrepotre: Filee;
  @ViewChild('editchkbox') editchkbox: MatCheckbox;
  @ViewChild('form') form: FormGroupDirective;
  public done = true;
  length = '';
  editerfield: boolean = false;
  public Editor = ClassicEditorBuild;
  public edittechinfo: boolean = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  public contact: string = '';
  public uploaded: boolean = false;
  public isopen: any = [];
  public requiredstate: boolean = true;
  constructor(private fb: FormBuilder,
    public toastr: ToastrService,
    public router: Router,
    private activeRoute: ActivatedRoute,
    private formBuilder: FormBuilder,
    private el: ElementRef,
    private security: Encrypt,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private vehicleService: ServiceVehiclemanagementService,
    private localstorage: AppLocalStorageServices,
    private cookieService: CookieService,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';
  config = {
    toolbar: [
      'heading',
      '|',
      'bold',
      'italic',
      '|',
      'bulletedList',
      'numberedList',
      '|',
      'blockquote',
      '|',
      'undo',
      'redo',
    ],
    image: {
      toolbar: [
        'imageStyle:full',
        'imageStyle:side',
        'imageStyle:alignLeft',
        'imageStyle:alignRight',

        '|',
        'imageTextAlternative'
      ],
      styles: [
        // This option is equal to a situation where no style is applied.
        'full',

        'side',

        // This represents an image aligned to the left.
        'alignLeft',

        // This represents an image aligned to the right.
        'alignRight'
      ]
    },
    table: {
      contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties',]
    },
    placeholder: "Type the content here!"
  }
  ngOnInit(): void {
    if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      if (toSelect.languagecode == 'en') {
        this.config.placeholder = "Type the content here!";

      } else {
        this.config.placeholder = "Type the content here!";

      }
    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
      this.config.placeholder = "Type the content here!";

    }
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    if (this.isfocalpoint == 2) {
      this.useraccess = this.localstorage.getInLocal('uerpermission');
      //console.log(this.useraccess);
      this.SetUseraccess();
    }

    this.remoteService.getLanguageCookie().subscribe(data => {
      //this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      // //console.log('welcome');
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        if (toSelect.languagecode == 'en') {
          this.config.placeholder = "Type the content here!";

        } else {
          this.config.placeholder = "Type the content here!";

        }
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        this.config.placeholder = "Type the content here!";

      }

    });
    this.activeRoute.paramMap.subscribe((params: ParamMap) => {
      if (!this.createaccess && this.isfocalpoint == 2) {
        this.Vehiclelist();
      }
      let pk = params.get('vcl_id');
      if (params.get('type') == 'edit') {
        this.isEdit = true;
      }

      this.veiclepk = this.security.decrypt(pk);
    })
    this.formvalidated();
    this.report = {
      fileMstPk: 18,
      selectedFilesPk: []
    };
    this.reportchklist = {
      fileMstPk: 19,
      selectedFilesPk: []
    };
    this.getVehicleRegistrationStatus();
    this.Form.vehicleregpk.setValue(this.veiclepk);

  }

  getVehicleRegistrationStatus() {
    this.loader = true;
    let status;
    let encpk = this.security.encrypt(this.veiclepk);
    this.vehicleService.getVehicleRegistrationStatus(encpk).subscribe(res => {
      this.vehicleregstatus = res.data.data;

      if (this.vehicleregstatus != 1 && this.vehicleregstatus != 4 && (this.vehicleregstatus != 5 && this.vehicleregstatus != 6 && this.vehicleregstatus != 7)) {
        this.Vehiclelist();
      }
      if ((this.vehicleregstatus == 5 || this.vehicleregstatus == 6 || this.vehicleregstatus == 7) && this.isEdit == true) {
        this.EditDataValue = [];
        this.fileupload = [];
        this.fileuploadvalue = null;
        this.vehicleService.getInspectionDetailsForEdit(encpk).subscribe(res => {
          if (res.data.status == 1) {
            if (Number(res.data.data.status) == 5 || Number(res.data.data.status) == 6) {
              status = 2;
              this.declineDtls['declinedOn'] = res.data.data.declinedOn;
              this.declineDtls['declinedBy'] = res.data.data.declinedBy;
              this.declineDtls['declinedComments'] = res.data.data.declineComments;

            }
            else {
              status = 7;
              this.declineDtls = null;
            }

            this.approveDecline.patchValue({
              vehicleregpk: this.veiclepk,
              status: status,
              inspctiontype: Number(res.data.data.inspType),
              comments: res.data.data.inspComment,
              reportdocument: res.data.data.inspReport ? res.data.data.inspReport.split(",") : []
            });

            this.contact = res.data.data.inspComment;
            this.techinfo = res.data.data.inspComment;
            this.EditDataValue = res.data.data.checklist;
            this.done = false;

            //  this.report = {
            //   fileMstPk: 18,
            //   selectedFilesPk: [res.data.data.inspReport ? res.data.data.inspReport.split(",") : []]]
            // };

            this.fileupload = res.data.data.inspReport ? res.data.data.inspReport.split(",") : [];
            this.fileuploadvalue = this.report;
            this.statustype(status);
            this.ChkInspType(Number(res.data.data.inspType));

            this.approvalstatus = false;


            this.assesmentrepot.triggerChange();
          }
        });
      }
      else {
        this.loader = false;
      }
    });
  }

  SetUseraccess() {
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Vehicle Inspection and Approval');

    if (this.useraccess[moduleid] && this.useraccess[moduleid][27] &&  this.useraccess[moduleid][27].read == 'Y') {
      this.readaccess = true;
    }
    if (this.useraccess[moduleid] && this.useraccess[moduleid][27] && this.useraccess[moduleid][27].create == 'Y') {
      this.createaccess = true;
    }

  }


  formvalidated() {
    this.approveDecline = this.formBuilder.group({
      vehicleregpk: ['', Validators.required],
      status: ['', Validators.required],
      inspctiontype: ['', Validators.required],
      reportdocument: ['', Validators.required],
      comments: ['', Validators.required],
      onlinechecklist: this.formBuilder.array([])
    });

  }
  createItem(value) {

    return this.fb.group({
      question: [value.aqm_question_en, ''],
      option: [value.ansoptions, ''],
      answer: ['', Validators.required],
      chklistcomments: ['', ''],
      chklistdoc: ['', '']
    })


  }

  getIfrequired(i) {
    if (this.isopen[i] == true) {
      this.updatevalidation(i, true);
      return true;
    }
    // //console.log('sdfsd')
    this.updatevalidation(i, false);
    return false;
  }

  movetoverifier() {

  //console.log(this.approveDecline)
    if (this.approveDecline.valid && this.done === false) {
      if (this.approveDecline.touched) {
        this.loader = true;
        let body = this.approveDecline.value;
        this.vehicleService.moveToVerifier(body).subscribe(response => {
          if (response.data.status == 1) {
            if (this.Form.status.value == 2) {
              this.toastr.success(this.i18n('This Vehicle Form has been moved to the Verifier.'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
            }
            else if (this.Form.status.value == 8) {
              this.toastr.success(this.i18n('This Vehicle Form has been Rejected.'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
            }
            else if (this.Form.status.value == 7) {
              this.toastr.success(this.i18n('This Vehicle Form has been Declined.'), ''), {
                timeOut: 2000,
                closeButton: false,
              };
            }

            this.Vehiclelist();
          }
          this.loader = false;
        });
      }
      else {
        swal({
          title: this.i18n('No updates received on the Vehicle Inspection form towards the Declines.'),
          text: '',
          icon: 'warning',
          buttons: [false, this.i18n('Ok')],
          dangerMode: true,
          className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
          closeOnClickOutside: false
        });
      }


    }
    else {
      swal({
        title: this.i18n('Kindly complete filling all the mandatory information before proceeding.'),
        text: '',
        icon: 'warning',
        buttons: [false, this.i18n('Ok')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      });
      this.loader = false;
      this.uploaded = true;

      if (this.approveDecline.controls.comments.invalid) {

        this.edittechinfo = true;
      }
      this.focusInvalidInput(this.approveDecline)
    }


  }
  submit() {
    //console.log(this.approveDecline.value)
    if (this.approveDecline.valid && this.done === false) {
      this.approveDecline.controls['status'].reset();
      this.approveDecline.controls['comments'].reset();
      this.approveDecline.controls['reportdocument'].reset();
      this.edittechinfo = !this.edittechinfo;
      this.toastr.success(this.i18n('maincenter.staffupdate'), ''), {
        timeOut: 2000,
        closeButton: false,
      };
    } else {
      swal({
        title: this.i18n('Kindly complete filling all the mandatory information before proceeding.'),
        text: '',
        icon: 'warning',
        buttons: [false, this.i18n('Ok')],
        dangerMode: true,
        className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
        closeOnClickOutside: false
      });
      this.loader = false;
      this.uploaded = true;
      if (!this.approveDecline.controls.comments.valid) {
        this.edittechinfo = true;
      }
      this.focusInvalidInput(this.approveDecline)
    }
  }
  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        // //console.log(key);
        if (invalidControl) {
          invalidControl.focus();
        }
        break;
      }
    }
  }
  get Form() { { return this.approveDecline.controls; } }

  cancel() {
    // //console.log(this.approveDecline);

    swal({
      title: this.i18n('Do you want cancel the Vehicle Inspection?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.approveDecline.reset();
        this.contact = '';
        this.techinfo = ''
        this.edittechinfo = !this.edittechinfo;
        this.uploaded = false;
        this.Vehiclelist();
      }
    });



  }


  Vehiclelist() {
    if (this.stktype == 1) {
      this.loader = false;
      this.router.navigate(['/vehiclemanagement/list']);
    }
    this.router.navigate(['/vehiclemanagement/vehiclelisting']);
  }

  ChkInspType(value) {
    this.loader = false;
    if (value == 1) {

      this.InspectionTemplate = 'Online';
      this.report.selectedFilesPk = Array();
      this.approveDecline.controls['reportdocument'].reset();
      this.approveDecline.controls['reportdocument'].clearValidators();
      this.approveDecline.controls['reportdocument'].setValidators(null);
      this.approveDecline.controls['reportdocument'].setErrors(null);
      this.approveDecline.controls['reportdocument'].updateValueAndValidity();
      this.approveDecline.controls['onlinechecklist'].updateValueAndValidity();
      this.getAllPassanswrs();
      this.getInspectionChecklistByVehicleRegPk();
      
      this.updateOnlineChecklist(true);
      

    }
    else {
     
      this.InspectionTemplate = 'Offline';
      if (this.isEdit == true) {
        this.report.fileMstPk = 18;
        this.report.selectedFilesPk = this.fileupload;
      }
      else {
        this.report.fileMstPk = 18;
        this.report.selectedFilesPk = Array();
      }

      this.approveDecline.controls['reportdocument'].reset();

      if (this.isEdit == true) {
        this.approveDecline.controls['reportdocument'].setValue(this.fileupload);
      }
      else{
         this.approveDecline.controls['reportdocument'].setValue(Array());
      }

      this.approveDecline.controls['reportdocument'].setValidators([Validators.required]);
      this.approveDecline.controls['reportdocument'].updateValueAndValidity();
      this.approveDecline.controls['onlinechecklist'].updateValueAndValidity();
      this.updateOnlineChecklist(false);

    }
    
    this.assesmentrepot.triggerChange();
  }

  updateOnlineChecklist(validator) {

    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
    if (validator) {
      Checklistarray.controls.forEach((formGroup: FormGroup) => {
        formGroup.controls['question'].setValidators([Validators.required]);
        formGroup.controls['answer'].setValidators([Validators.required]);
        formGroup.controls['chklistcomments'].setValidators([Validators.required]);
        formGroup.controls['chcklistdoc'].setValidators([Validators.required, this.minLengthArrayValidator(1)]);
        formGroup.controls['question'].updateValueAndValidity();
        formGroup.controls['answer'].updateValueAndValidity();
        formGroup.controls['chklistcomments'].updateValueAndValidity();
        formGroup.controls['chcklistdoc'].updateValueAndValidity();
      });
    }
    else {

      Checklistarray.controls.forEach((formGroup: FormGroup) => {
        formGroup.controls['answer'].setValue(null);
        formGroup.controls['chklistcomments'].setValue(null);
        formGroup.controls['chcklistdoc'].setValue(null);
        formGroup.controls['question'].setValidators(null);
        formGroup.controls['answer'].setValidators(null);
        formGroup.controls['chklistcomments'].setValidators(null);
        formGroup.controls['chcklistdoc'].setValidators(null);
        formGroup.controls['question'].updateValueAndValidity();
        formGroup.controls['answer'].updateValueAndValidity();
        formGroup.controls['chklistcomments'].updateValueAndValidity();
        formGroup.controls['chcklistdoc'].updateValueAndValidity();
      });
    }
  }

  statustype(value) {

    if (value == 2) {
      this.approvalstatus = true;
    } else if (value == 7 || value == 8) {
      this.approvalstatus = false;
    }
  }
  getInspectionChecklistByVehicleRegPk() {
    this.loader = true;
    let encpk = this.security.encrypt(this.veiclepk);
    let editvalue = this.EditDataValue;
    this.vehicleService.getInspectionChecklistByVehicleRegPk(encpk).subscribe(res => {

      if (res.data.status == 1) {
        this.addChecklist(res.data.data, editvalue, true);
      }
      else {
        this.checklist = [];
      }
    });

  }

  addChecklist(value, editvalue = null, validator = null) {


    let cheklistDocs = []
    let cheklistDocsValidation: any[] = [];
    const control = <FormArray>this.approveDecline.controls['onlinechecklist'];

    //console.log(this.isEdit == false , editvalue?.length == 0 , control.controls?.length == 0)

    if  ((this.isEdit == false || editvalue.length == 0) && control.controls.length == 0) {
      for (let i = 0; i < value.length; i++) {
        cheklistDocs.push({
          fileMstPk: 19,
          selectedFilesPk: []
        });
        if (validator) {
          control.push(
            this.formBuilder.group({
              question: [value[i].auditquestionmst_pk, [Validators.required]],
              answer: ['', [Validators.required]],
              chklistcomments: ['', ''],
              chcklistdoc: [Array(), '']
            })
          );
        }
        else {
          control.push(
            this.formBuilder.group({
              question: [value[i].auditquestionmst_pk, ''],
              answer: ['', ''],
              chklistcomments: ['', ''],
              chcklistdoc: [Array(), '']
            })
          );
        }

      }
      this.ChekclistDocuments = cheklistDocs;
    }
    else {
      if(control.controls.length > 0 && editvalue?.length > 0)
      {
        for (let i = 0; i < value.length; i++) {
        Object.keys(editvalue).forEach(key => {

          if (editvalue[key].mstPk == value[i].auditquestionmst_pk) {


            if (editvalue[key].ansoptions[0].ansDoc) {
              cheklistDocs.push({
                fileMstPk: 19,
                selectedFilesPk: editvalue[key].ansoptions[0].ansDoc?.split(",") ? editvalue[key].ansoptions[0].ansDoc?.split(",") : [],
              });
            } else {
              cheklistDocs.push({
                fileMstPk: 19,
                selectedFilesPk: []
              });
            }
            const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
                    Checklistarray.controls.forEach((formgroup: FormGroup) => {
                              if (formgroup) {
                                    if(formgroup.controls['question'].value == value[i].auditquestionmst_pk)
                                    {
                                      formgroup.controls['answer'].setValue(editvalue[key].ansoptions[0].mstPk);
                                      formgroup.controls['chklistcomments'].setValue(editvalue[key].ansoptions[0].ansComments);
                                      formgroup.controls['chcklistdoc'].setValue(editvalue[key].ansoptions[0].ansDoc ? editvalue[key].ansoptions[0].ansDoc.split(",") : null);
                                      formgroup.controls['question'].updateValueAndValidity();
                                      formgroup.controls['answer'].updateValueAndValidity();
                                      formgroup.controls['chklistcomments'].setValidators(null);
                                      formgroup.controls['chcklistdoc'].setValidators(null);
                                      formgroup.controls['chklistcomments'].updateValueAndValidity();
                                      formgroup.controls['chcklistdoc'].updateValueAndValidity();
                                      this.ChekclistDocuments = cheklistDocs;
                                      if (Number(editvalue[key].toggleOpen) == 1) {
                                        
                                        this.toggle(Number(key));
                                      }
                                    }
                                }
                               
                    });
           
            
          }

        });


      }
      }
      else if(editvalue?.length > 0){
        control.controls = [];
        for (let i = 0; i < value.length; i++) {
        Object.keys(editvalue).forEach(key => {

          if (editvalue[key].mstPk == value[i].auditquestionmst_pk) {


            if (editvalue[key].ansoptions[0].ansDoc) {
              cheklistDocs.push({
                fileMstPk: 19,
                selectedFilesPk: editvalue[key].ansoptions[0].ansDoc?.split(",") ? editvalue[key].ansoptions[0].ansDoc?.split(",") : [],
              });
            } else {
              cheklistDocs.push({
                fileMstPk: 19,
                selectedFilesPk: []
              });
            }
            control.push(
              this.formBuilder.group({
                question: [value[i].auditquestionmst_pk, [Validators.required]],
                answer: [editvalue[key].ansoptions[0].mstPk, [Validators.required]],
                chklistcomments: [editvalue[key].ansoptions[0].ansComments, ''],
                chcklistdoc: [editvalue[key].ansoptions[0].ansDoc ? editvalue[key].ansoptions[0].ansDoc.split(",") : null, '']
              })
            );
            
            this.ChekclistDocuments = cheklistDocs;
            if (Number(editvalue[key].toggleOpen) == 1) {
              this.toggle(Number(key));
            }
          }

        });


       }
      }
      else{
        this.updateOnlineChecklist(false);
      }
    }
    this.loader = false;

    //console.log(this.ChekclistDocuments)
    this.formBuilder.group(cheklistDocsValidation);
    this.checklist = value;
    this.checkIfAllPass();
  }

  fileeSelected(file, fileId) {
    if (file.length > 0) {
      this.Form.reportdocument.setValue(file);
      this.fileupload = file;
    }
    else {
      this.Form.reportdocument.setValue(null);
      this.fileupload = [];
    }
  }

  fileeSelectedChecklist(file, fileId) {
    // // //console.log(file, fileId);
  }



  editinfo() {
    //console.log('edit');
    this.edittechinfo = !this.edittechinfo;
    this.done = true;
    // //console.log(this.done);

  }

  messagedone() {
    // //console.log('done');
    this.addinfo();
    this.editinfo();
    this.done = false;
    // //console.log(this.done);
  }
  addinfo() {
    // //console.log('add');
    this.techinfo = this.approveDecline.controls['comments'].value;

  }
  onChangeeditor(event) {
    this.length_Of_ck = $(this.approveDecline.controls['comments'].value).text().length;
    this.comments = $(this.approveDecline.controls['comments'].value).text();
    if (this.length_Of_ck > 1000) {
      this.approveDecline.setErrors({ 'invalid': true });
      this.approveDecline.controls['comments'].setErrors({ 'incorrect': true });
    }


  }
  resinfo() {
    this.approveDecline.controls['comments'].reset();
    this.techinfo = "";
  }
  questions = [
    {
      title: 'Position'
    },
    {
      title: 'position-2'
    }
  ];
  toggle(index: number): void {
    this.isopen[index] = !this.isopen[index];
    

    if (this.isopen[index] == false) {
      

      this.updatevalidation(index, false);
    }
    else {
      this.updatevalidation(index, true);
    }

    // //console.log(this.isopen[index]);

  }


  updatevalidation(index, value) {
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
    const formgroup = Checklistarray.controls[index] as FormGroup;

    

    if (formgroup) {
      //console.log(formgroup);
      if (value == true) {
        formgroup.controls['chklistcomments'].setValidators([Validators.required]);
        formgroup.controls['chcklistdoc'].setValidators([Validators.required]);
        // formgroup.controls['chcklistdoc'].setValue(Array());
        formgroup.controls['chklistcomments'].updateValueAndValidity();
        formgroup.controls['chcklistdoc'].updateValueAndValidity();
        ////console.log(this.ChekclistDocuments);
        // this.ChekclistDocuments[index].selectedFilesPk = Array();
        this.loader = false;


      }
      else {
        // //console.log(formgroup.controls['chcklistdoc'].value)
        formgroup.controls['chklistcomments'].setValue(null);

        formgroup.controls['chklistcomments'].setValidators(null);
        formgroup.controls['chcklistdoc'].setValidators(null);
        formgroup.controls['chklistcomments'].setErrors(null);
        formgroup.controls['chcklistdoc'].setErrors(null);
        formgroup.controls['chcklistdoc'].setValue(Array());
        formgroup.controls['chklistcomments'].updateValueAndValidity();
        formgroup.controls['chcklistdoc'].updateValueAndValidity();
        ////console.log(this.ChekclistDocuments);
        this.ChekclistDocuments[index].selectedFilesPk = Array();
        this.loader = false;
      }

      console.log(formgroup.controls);
    }


  }

  getChecklistForm(i) {
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
    const formgroup = Checklistarray.controls[i] as FormGroup;

    return formgroup;
  }


  minLengthArrayValidator(minLength: number): ValidatorFn {
    return (control: FormControl): { [key: string]: any } | null => {
      const value: any[] = control.value;

      if (!value || !Array.isArray(value)) {
        return Validators.required(control);
      }

      if (value.length < minLength) {
        return { minLengthArray: { requiredLength: minLength, actualLength: value.length } };
      }

      return null;
    };
  }

  getAllPassanswrs(value = null) {
    this.vehicleService.getAllPassAnswersForChklist(this.security.encrypt(this.veiclepk)).subscribe(res => {
      this.passanswrslist = res.data.data;
      if(value)
      {
        this.checkAllFun(value);
      }
      
    });


  }

  checkAllFun(value) {
    this.loader = true;
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;

    if (this.passanswrslist && this.passanswrslist?.length > 0) {
      
      Checklistarray.controls.forEach((formGroup: FormGroup) => {

        this.passanswrslist.forEach(element => {
          if (element.question == formGroup.controls['question'].value) {
            if (value == true) {
              formGroup.controls['answer'].setValue(element.answer);
             
            }
            else {
              formGroup.controls['answer'].setValue(null);
              
            }

            formGroup.controls['answer'].updateValueAndValidity();
          }

        });
      });
      this.approveDecline.markAsTouched();
      this.loader = false;

    }
    else
    {
      this.getAllPassanswrs(value);
    }

  }

  checkIfAllPass()
  {
    let passcount = 0;
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;

    if (this.passanswrslist && this.passanswrslist.length > 0) {
      
      Checklistarray.controls.forEach((formGroup: FormGroup) => {

        this.passanswrslist.forEach(element => {
          if (element.question == formGroup.controls['question'].value) {
            if (formGroup.controls['answer'].value == element.answer) {
              passcount = passcount + 1;
            }
          }

        });
      });

    }
    if(passcount == this.passanswrslist?.length)
      {
        this.editchkbox.checked = true;
      }
      else
      {
        this.editchkbox.checked = false;
      }  
  }

}
