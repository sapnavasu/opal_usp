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
import { Filee } from '@app/@shared/filee/filee';
import { MatCheckbox } from '@angular/material/checkbox';
import { Encrypt } from '@app/common/class/encrypt';
import { IvmsdeviceService } from '@app/services/ivmsdev.service';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import { IvmslimitmodelComponent } from '../ivmslimitmodel/ivmslimitmodel.component';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
@Component({
  selector: 'app-uploadreport',
  templateUrl: './uploadreport.component.html',
  styleUrls: ['./uploadreport.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class UploadreportComponent implements OnInit {
  devicePk: string;
  vehicleregstatus: any;
  EditDataValue: any[];
  declineDtls: any = []; categorylist: any;
  answerlistform: FormGroup;
  list: boolean;
  ifonline:boolean = true;
  ifoffline:boolean = false;
  ChekclistDocuments: any = [];
  public isopen: any = [];
  passanswrslist: any;
  editchk: any = [];
  categoryppks: any = [];
  inspcData: any;
  approved: boolean;
  decline: boolean;
  status: number;
  onlinechklistresponse: any[];
  i18n(key) {
    return this.translate.instant(key);
  }
  @ViewChild('assesmentrepot') assesmentrepot: Filee;
  @ViewChild('assesmentrepotre') assesmentrepotre: Filee;
  public ifarbic: boolean = false;
  public loader: boolean = false;
  public InspectionTemplate: string = "Offline";
  public report: DriveInput;
  public reportchklist: DriveInput;
  public approveDecline: FormGroup;
  public fileupload: any[] = [];
  public fileuploadvalue: any;
  public isEdit: boolean = false;
  public done = true;
  public length = '';
  public editerfield: boolean = false;
  public Editor = ClassicEditorBuild;
  public edittechinfo: boolean = false;
  public techinfo = "";
  public length_Of_ck = 0;
  public comments = '';
  public contact: string = '';
  public uploaded: boolean = false;
  public deleteicon: boolean = true;
  public stktype: any;
  public defaultSelected: any = 0;

  public approvalstatus: boolean = true;
  constructor(private fb: FormBuilder,
    public toastr: ToastrService,
    public router: Router,
    private activeRoute: ActivatedRoute,
    private formBuilder: FormBuilder,
    private el: ElementRef,
    private translate: TranslateService,
    private remoteService: RemoteService,
    private security: Encrypt,
    private ivmsService: IvmsdeviceService,
    private localstorage:AppLocalStorageServices,
    private cookieService: CookieService,private dialog: MatDialog) { }

  checklist = [
    {
      aqm_question_en: 'Compliance Declaration', checkboxName: 'Approve All', checklist: [
        { rviqd_question_en: 'Compliance Declaration' }
      ], ansoptions: [
        { aad_answer_en: 'Approve' },
        { aad_answer_en: 'Not Approve' }
      ]
    }
  ]

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

    } else {
      const toSelect = this.languagelist.find(c => c.id == '1');
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;

    }
    if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
      this.ifarbic = true
    }
    else {
      this.ifarbic = false;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      if (this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null) {
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      } else {
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
      if (this.cookieService.get('languageCode') && this.cookieService.get('languageCode') == 'ar') {
        this.ifarbic = true
      }
      else {
        this.ifarbic = false;
      }
      this.stktype = this.localstorage.getInLocal('stktype');

    });

    this.activeRoute.paramMap.subscribe((params: ParamMap) => {
      // if (!this.createaccess && this.isfocalpoint == 2) {
      //   this.Vehiclelist();
      // }
      // if (params.get('type') == 'edit') {
      //   this.isEdit = true;
      // }
      let pk = params.get('dev_id');
      this.devicePk = this.security.decrypt(pk);
      this.getType();

      if(this.isEdit == false)
      {
        this.loader = true;
        this.getnumberofinstalations();
      }

    })
    this.formvalidated()
    this.report = {
      fileMstPk: 21,
      selectedFilesPk: []
    };
    this.reportchklist = {
      fileMstPk: 22,
      selectedFilesPk: []
    };
    this.getIVMSVehicleRegistrationStatus();
    this.Form.vehicleregpk.setValue(this.devicePk);
    // this.openDialog();
  }

  getInspectionDetails()
   {
    if(this.devicePk)
    {
      let encPk = this.security.encrypt(this.devicePk);
      this.ivmsService.getInstallationDtls(encPk).subscribe(res => {
        if(res.data.status == 1)
        {
            this.inspcData = res.data.data ;
            this.status = this.inspcData.ivrd_installationstatus;
            if(this.status == 1 )
            {
              this.inspcData = null;
            }
            this.decline = false;
            this.approved = false;
            if(this.status == 3)
            {
              this.approved = true;
              this.decline = false;
            }
            if(this.status == 7)
            {
              
              this.decline = true;
              this.approved = false;
            }
            this.loader = false;
        }
        else
        {
          this.loader = false;
         this.inspcData = null;
        //  swal({
        //    title: this.i18n('Unable To Fetch the Ispection details'),
        //    icon: 'warning',
        //    className: this.dir =='ltr'?'swalEng':'swalAr',
        //    closeOnClickOutside: false
        //  })
        }
        });
    }
     
   }

  getnumberofinstalations()
  {
    let encpk = this.security.encrypt(this.devicePk);
    this.ivmsService.getnumberofinstalations(encpk).subscribe(res => {
     this.loader = false;
      if(res.data.status == 1)
      {
        if(res.data.data.result == false)
        {
          this.openDialog(res.data.data.installation,res.data.data.technician);
        }
      }
      
    });
  }

  // formvalidated() {
  //   this.approveDecline = this.formBuilder.group({
  //     vehicleregpk: ['', Validators.required],
  //     status: ['', Validators.required],
  //     inspctiontype: ['', Validators.required],
  //     reportdocument: ['', Validators.required],
  //     comments: ['', Validators.required],
  //     chklistcomments: ['', Validators.required],
  //     chcklistdoc: ['', Validators.required],
  //     trigger: ['', Validators.required],
  //     cabin: ['', Validators.required],
  //     emilalert: ['', ''],
  //     decivesms: ['', ''],
  //     gateways: ['', ''],
  //   });
  // }

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

  getIVMSVehicleRegistrationStatus() {
    this.loader = true;
    let status;
    let encpk = this.security.encrypt(this.devicePk);
    this.ivmsService.getIVMSVehicleRegistrationStatus(encpk).subscribe(res => {
      this.vehicleregstatus = res.data.data;

      // if (this.vehicleregstatus != 1 && this.vehicleregstatus != 4 && (this.vehicleregstatus != 5 && this.vehicleregstatus != 6 && this.vehicleregstatus != 7)) {
      //   this.Vehiclelist();
      // }
      if ((this.vehicleregstatus == 7) && this.isEdit == true) {
        this.EditDataValue = [];
        this.fileupload = [];
        this.fileuploadvalue = null;
        this.getAllPassanswrs();
        this.ivmsService.getIVMSInspectionDetailsForEdit(encpk).subscribe(res => {
          if (res.data.status == 1) {
            if (Number(res.data.data.status) == 7) {
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
              vehicleregpk: this.devicePk,
              status: status,
              inspctiontype: Number(res.data.data.inspType),
              comments: res.data.data.inspComment,
              reportdocument: res.data.data.inspReport ? res.data.data.inspReport?.split(",") : []
            });

            this.contact = res.data.data.inspComment;
            this.techinfo = res.data.data.inspComment;

            this.EditDataValue = res.data.data.checklist;
            this.done = false;
            this.fileupload = res.data.data.inspReport ? res.data.data.inspReport?.split(",") : [];
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

  statustype(value) {

    if (value == 2) {
      this.approvalstatus = true;
    } else if (value == 7 || value == 8) {
      this.approvalstatus = false;
    }
  }



  get Form() { { return this.approveDecline.controls; } }



  getInstallationChecklistByVehicleRegPk() {
    this.loader = true;
    let encpk = this.security.encrypt(this.devicePk);
    let editvalue = this.EditDataValue;

    this.ivmsService.getInstallationChecklistByVehicleRegPk(encpk).subscribe(res => {

      if (res.data.status == 1) {
        this.addChecklist(res.data.data, editvalue, true);
      }
      else {
        this.checklist = [];
      }
    });



  }

  addcategorylist(value, index, editvalue = null, key1 = null, validator = null) {

    let cheklistDocs = []
    let cheklistDocsValidation: any[] = [];
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
    const control = Checklistarray.controls[index].get('categorylist') as FormArray;


    if (editvalue) {
      for (let i = 0; i < value.length; i++) {
        Object.keys(editvalue).forEach(key => {
          if (editvalue[key].ansoptions.ansDoc) {
            cheklistDocs.push({
              fileMstPk: 22,
              selectedFilesPk: editvalue[key].ansoptions.ansDoc?.split(",") ? editvalue[key].ansoptions.ansDoc?.split(",") : [],
            });
          } else {
            cheklistDocs.push({
              fileMstPk: 22,
              selectedFilesPk: []
            });
          }

          if (validator) {

            if (value[i].aqm_questiontype == 3) {

              if (Number(key) == i && Number(key1) == index) {
                control.push(
                  this.formBuilder.group({
                    question: [value[i].auditquestionmst_pk, [Validators.required]],
                    questiontyp: [value[i].aqm_questiontype, [Validators.required]],
                    answerlist: this.formBuilder.array([]),
                    chklistcomments: [editvalue[key].ansoptions.ansComments, ''],
                    chcklistdoc: [editvalue[key].ansoptions.ansDoc, '']
                  })
                );
                

                if (Number(editvalue[key].toggleOpen) == 1) {

                  this.toggle(Number(key1), Number(key));
                }

                this.addanswerlist(value[i]['ansoptions'], i, index, editvalue[key].ansoptions, key, key1);
              }

            }
            else {

              if (Number(key) == i && Number(key1) == index) {
                control.push(
                  this.formBuilder.group({
                    question: [value[i].auditquestionmst_pk, [Validators.required]],
                    questiontyp: [value[i].aqm_questiontype, [Validators.required]],
                    answer: [editvalue[key].ansoptions.mstPk, [Validators.required]],
                    chklistcomments: [editvalue[key].ansoptions.ansComments, ''],
                    chcklistdoc: [editvalue[key].ansoptions.ansDoc, '']
                  })
                );

                
                if (Number(editvalue[key].toggleOpen) == 1) {

                  this.toggle(Number(key1), Number(key));
                }
              }



            }
          }
          else {
            if (value[i].aqm_questiontype == 3) {

              if (Number(key) == i && Number(key1) == index) {
                control.push(
                  this.formBuilder.group({
                    question: [value[i].auditquestionmst_pk, [Validators.required]],
                    questiontyp: [value[i].aqm_questiontype, [Validators.required]],
                    answerlist: this.formBuilder.array([]),
                    chklistcomments: [editvalue[key].ansoptions.ansComments, ''],
                    chcklistdoc: [editvalue[key].ansoptions.ansDoc, '']
                  })
                );
                if (Number(editvalue[key].toggleOpen) == 1) {

                  this.toggle(Number(key1), Number(key));
                }

                this.addanswerlist(value[i]['ansoptions'], i, index, editvalue[key].ansoptions, key, key1);
              }

            }
            else {

              if (Number(key) == i && Number(key1) == index) {
                control.push(
                  this.formBuilder.group({
                    question: [value[i].auditquestionmst_pk, [Validators.required]],
                    questiontyp: [value[i].aqm_questiontype, [Validators.required]],
                    answer: [editvalue[key].ansoptions.mstPk, [Validators.required]],
                    chklistcomments: [editvalue[key].ansoptions.ansComments, ''],
                    chcklistdoc: [editvalue[key].ansoptions.ansDoc, '']
                  })
                );
                if (Number(editvalue[key].toggleOpen) == 1) {

                  this.toggle(Number(key1), Number(key));
                }
              }


            }
          }
        });

      }


    } else {
      for (let i = 0; i < value.length; i++) {
        cheklistDocs.push({
          fileMstPk: 22,
          selectedFilesPk: []
        });
        if (validator) {
          if (value[i].aqm_questiontype == 3) {
            control.push(
              this.formBuilder.group({
                question: [value[i].auditquestionmst_pk, [Validators.required]],
                questiontyp: [value[i].aqm_questiontype, [Validators.required]],
                answerlist: this.formBuilder.array([]),
                chklistcomments: ['', ''],
                chcklistdoc: [Array(), '']
              })
            );
            // console.log(valu)
            // this.addanswerlist(value[i]['ansop'],i,index);

          }
          else {
            control.push(
              this.formBuilder.group({
                question: [value[i].auditquestionmst_pk, [Validators.required]],
                questiontyp: [value[i].aqm_questiontype, [Validators.required]],
                answer: ['', [Validators.required]],
                chklistcomments: ['', ''],
                chcklistdoc: [Array(), '']
              })
            );
          }

        }
        else {
          if (value[i].aqm_questiontype == 3) {
            control.push(
              this.formBuilder.group({
                question: [value[i].auditquestionmst_pk, [Validators.required]],
                questiontyp: [value[i].aqm_questiontype, [Validators.required]],
                answerlist: this.formBuilder.array([]),
                chklistcomments: ['', ''],
                chcklistdoc: [Array(), '']
              })
            );

            this.addanswerlist(value[i]['ansoptions'], i, index);


          }
          else {
            control.push(
              this.formBuilder.group({
                question: [value[i].auditquestionmst_pk, [Validators.required]],
                questiontyp: [value[i].aqm_questiontype, [Validators.required]],
                answer: ['', [Validators.required]],
                chklistcomments: ['', ''],
                chcklistdoc: [Array(), '']
              })
            );

          }
        }

      }
    }


    this.ChekclistDocuments[index] = cheklistDocs;

  }

  addanswerlist(value, index, chklistindex, editvalue = null, key1 = null, key2 = null, validator = null) {

    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
    const categorylistarray = Checklistarray.controls[chklistindex].get('categorylist') as FormArray;
    const control = categorylistarray.controls[index].get('answerlist') as FormArray;

    if (editvalue) {

      for (let i = 0; i < value.length; i++) {
        Object.keys(editvalue).forEach(key => {
          if (validator) {
            if (Number(key) == i && Number(key1) == index && Number(key2) == chklistindex) {
              control.push(
                this.formBuilder.group({
                  trigger: [editvalue[key].details, ''],
                  anspk: [value[i].auditanswerdtls_pk, [Validators.required]],
                })
              );
            }
          }
          else {

            if (Number(key) == i && Number(key1) == index && Number(key2) == chklistindex) {
              control.push(
                this.formBuilder.group({
                  trigger: [editvalue[key].details, ''],
                  anspk: [value[i].auditanswerdtls_pk, ''],
                })
              );
            }



          }
        });
      }
    }
    else {
      for (let i = 0; i < value.length; i++) {
        if (validator) {
          control.push(
            this.formBuilder.group({
              trigger: ['', ''],
              anspk: [value[i].auditanswerdtls_pk, [Validators.required]],
            })
          );
        }
        else {
          control.push(
            this.formBuilder.group({
              trigger: ['', ''],
              anspk: [value[i].auditanswerdtls_pk, ''],
            })
          );
        }
      }
    }



  }

  checkIfAllPass(pk) {

    let passcount = 0;
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
    console.log(this.passanswrslist)

    if (this.passanswrslist && this.passanswrslist[pk] && this.passanswrslist[pk].length > 0) {
      let i = 0;
      Checklistarray.controls.forEach((formGroup: FormGroup) => {



        if (formGroup.controls['categorypk'].value == pk) {
          const control = Checklistarray.controls[i].get('categorylist') as FormArray;
          control.controls.forEach((formGroupcategory: FormGroup) => {

            this.passanswrslist[pk].forEach(element => {
              if (element.question == formGroupcategory.controls['question'].value) {
                if (formGroupcategory.controls['answer'].value == element.answer) {
                  passcount = passcount + 1;
                }
              }

            });


          });
        }
        i++;
      });

      if (passcount == this.passanswrslist[pk]?.length) {
        this.editchk[pk] = true;
      }
      else {
        this.editchk[pk] = false;
      }
    }


  }

  addChecklist(value, editvalue = null, validator = null) {
    this.list = false;
    let cheklistDocsValidation: any[] = [];
    const control = <FormArray>this.approveDecline.controls['onlinechecklist'];

    if ((this.isEdit == false || editvalue.length == 0) && control.controls.length == 0) {

      for (let i = 0; i < value.length; i++) {

        if (validator) {
          control.push(
            this.formBuilder.group({
              categorylist: this.formBuilder.array([]),
              categoryname: value[i].categoryname_en,
              categorypk: value[i].auditchklstmst_pk,
            })
          );
          this.addcategorylist(value[i]['ques'], i);

        }
        else {

          control.push(
            this.formBuilder.group({
              categorylist: this.formBuilder.array([]),
              categoryname: value[i].categoryname_en,
              categorypk: value[i].auditchklstmst_pk,
            })
          );
          this.addcategorylist(value[i]['ques'], i);
        }

      }

    }
    else {
      if (control.controls.length > 0 && editvalue?.length > 0) {

        control.clear();
        this.approveDecline.controls['onlinechecklist'].setValidators(null);
        this.approveDecline.controls['onlinechecklist'].setErrors(null);
        this.approveDecline.controls['onlinechecklist'].updateValueAndValidity();
        console.log(control);
        this.addChecklist(value, editvalue);
        // for (let i = 0; i < value.length; i++) {
        //   Object.keys(editvalue).forEach(key => {

        //     if (editvalue[key].mstPk == value[i].auditquestionmst_pk) {


        //       if (editvalue[key].ansoptions[0].ansDoc) {
        //         cheklistDocs.push({
        //           fileMstPk: 22,
        //           selectedFilesPk: editvalue[key].ansoptions[0].ansDoc?.split(",") ? editvalue[key].ansoptions[0].ansDoc?.split(",") : [],
        //         });
        //       } else {
        //         cheklistDocs.push({
        //           fileMstPk: 22,
        //           selectedFilesPk: []
        //         });
        //       }
        //       const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
        //       Checklistarray.controls.forEach((formgroup: FormGroup) => {
        //         if (formgroup) {
        //           if (formgroup.controls['question'].value == value[i].auditquestionmst_pk) {
        //             formgroup.controls['answer'].setValue(editvalue[key].ansoptions[0].mstPk);
        //             formgroup.controls['chklistcomments'].setValue(editvalue[key].ansoptions[0].ansComments);
        //             formgroup.controls['chcklistdoc'].setValue(editvalue[key].ansoptions[0].ansDoc ? editvalue[key].ansoptions[0].ansDoc.split(",") : null);
        //             formgroup.controls['question'].updateValueAndValidity();
        //             formgroup.controls['answer'].updateValueAndValidity();
        //             formgroup.controls['chklistcomments'].setValidators(null);
        //             formgroup.controls['chcklistdoc'].setValidators(null);
        //             formgroup.controls['chklistcomments'].updateValueAndValidity();
        //             formgroup.controls['chcklistdoc'].updateValueAndValidity();
        //             this.ChekclistDocuments = cheklistDocs;
        //             if (Number(editvalue[key].toggleOpen) == 1) {

        //               this.toggle(Number(key));
        //             }
        //           }
        //         }
        //       });
        //     }
        //   });
        // }
      }
      else if (editvalue?.length > 0) {

        control.controls = [];


        for (let i = 0; i < value.length; i++) {
          Object.keys(editvalue).forEach(key => {

            if (Number(key) == i) {
              if (validator) {
                control.push(
                  this.formBuilder.group({
                    categorylist: this.formBuilder.array([]),
                    categoryname: value[i].categoryname_en,
                    categorypk: value[i].auditchklstmst_pk,
                  })
                );
                this.addcategorylist(value[i]['ques'], i, editvalue[key].ques, key);
                if (value[i].ques[0].aqm_questiontype == 1) {
                  this.categoryppks.push(value[i].auditchklstmst_pk);
                }
              }
              else {

                control.push(
                  this.formBuilder.group({
                    categorylist: this.formBuilder.array([]),
                    categoryname: value[i].categoryname_en,
                    categorypk: value[i].auditchklstmst_pk,
                  })
                );

                this.addcategorylist(value[i]['ques'], i, editvalue[key].ques, key);
                if (value[i].ques[0].aqm_questiontype == 1) {
                  this.categoryppks.push(value[i].auditchklstmst_pk);
                }

              }
            }

          });


        }
        console.log(this.approveDecline.controls.onlinechecklist)
      }
      else {
        // this.updateOnlineChecklist(false);
      }
    }
    this.loader = false;
    this.list = true;


    this.formBuilder.group(cheklistDocsValidation);
    this.checklist = value;
    this.checkIfAllPassAll();
  }

  checkIfAllPassAll() {
    this.categoryppks.forEach(element => {
      this.checkIfAllPass(element);

    });
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
      this.getInstallationChecklistByVehicleRegPk();

      this.updateOnlineChecklist(true);
    }
    else {

      this.InspectionTemplate = 'Offline';
      if (this.isEdit == true) {
        this.report.fileMstPk = 21;
        this.report.selectedFilesPk = this.fileupload;
      }
      else {
        this.report.fileMstPk = 21;
        this.report.selectedFilesPk = Array();
      }

      this.approveDecline.controls['reportdocument'].reset();

      if (this.isEdit == true) {
        this.approveDecline.controls['reportdocument'].setValue(this.fileupload);
      }
      else {
        this.approveDecline.controls['reportdocument'].setValue(Array());
      }

      this.approveDecline.controls['reportdocument'].setValidators([Validators.required]);
      this.approveDecline.controls['reportdocument'].updateValueAndValidity();
      this.approveDecline.controls['onlinechecklist'].updateValueAndValidity();
      this.updateOnlineChecklist(false);

    }

  }
  focusInvalidInput(form) {
    for (const key of Object.keys(form.controls)) {
      if (form.controls[key].invalid) {
        const invalidControl = this.el.nativeElement.querySelector('[formcontrolname="' + key + '"]');
        if (invalidControl) {
          console.log(invalidControl)
          invalidControl.focus();
        }
        break;
      }
    }
  }

  editinfo() {
    this.edittechinfo = !this.edittechinfo;
    this.done = true;

  }

  messagedone() {
    this.addinfo();
    this.editinfo();
    this.done = false;
  }
  addinfo() {
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
  // submitfoapproval() {
  //   console.info(this.approveDecline)
  //   if(this.approveDecline.valid) {
  //     this.toastr.success(this.i18n('This IVMS Form has been moved to the Verifier.'), ''), {
  //       timeOut: 2000,
  //       closeButton: false,
  //     };
  //     this.Vehiclelist()
  //   }
  //   else {
  //     this.focusInvalidInput(this.approveDecline)
  //   }
  // }

  updateOnlineChecklist(validator) {

    if (validator) {
      const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
      let i = 0;
      Checklistarray.controls.forEach((formGroup: FormGroup) => {
        const control = Checklistarray.controls[i].get('categorylist') as FormArray;

        let j = 0;
        control.controls.forEach((formGroupcategory: FormGroup) => {
          if (formGroupcategory.controls['answerlist']) {
            const answercontrol = control.controls[j].get('answerlist') as FormArray;
            answercontrol.controls.forEach((formGroupanswerlist: FormGroup) => {
              formGroupanswerlist.controls['trigger'].setValidators(null);
              formGroupanswerlist.controls['anspk'].setValidators([Validators.required]);
              formGroupanswerlist.controls['trigger'].updateValueAndValidity();
              formGroupanswerlist.controls['anspk'].updateValueAndValidity();
            });
            formGroupcategory.controls['answerlist'].setValidators([Validators.required]);
            formGroupcategory.controls['answerlist'].updateValueAndValidity();
          }
          else {
            formGroupcategory.controls['answer'].setValidators([Validators.required]);
            formGroupcategory.controls['answer'].updateValueAndValidity();
          }

          formGroupcategory.controls['question'].setValidators([Validators.required]);
          formGroupcategory.controls['questiontyp'].setValidators([Validators.required]);
          formGroupcategory.controls['chcklistdoc'].setValidators([this.minLengthArrayValidator(1)]);
          formGroupcategory.controls['question'].updateValueAndValidity();
          formGroupcategory.controls['questiontyp'].updateValueAndValidity();
          formGroupcategory.controls['chklistcomments'].updateValueAndValidity();
          formGroupcategory.controls['chcklistdoc'].updateValueAndValidity();

          j++;
        });
        formGroup.controls['categoryname'].setValidators([Validators.required]);
        formGroup.controls['categorypk'].setValidators([Validators.required]);
        formGroup.controls['categorylist'].setValidators([Validators.required]);
        formGroup.controls['categoryname'].updateValueAndValidity();
        formGroup.controls['categorypk'].updateValueAndValidity();
        formGroup.controls['categorylist'].updateValueAndValidity();
        i++;
        console.log(i)
      });
    }
    else {
      const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
      var i = 0;

      Checklistarray.controls.forEach((formGroup: FormGroup) => {

        const control = Checklistarray.controls[i].get('categorylist') as FormArray;
        var j = 0;
        control.controls.forEach((formGroupcategory: FormGroup) => {

          if (formGroupcategory.controls['answerlist']) {
            const answercontrol = control.controls[j].get('answerlist') as FormArray;
            answercontrol.controls.forEach((formGroupanswerlist: FormGroup) => {
              formGroupanswerlist.controls['trigger'].setValue(null);
              formGroupanswerlist.controls['anspk'].setValue(null);
              formGroupanswerlist.controls['trigger'].setValidators(null);
              formGroupanswerlist.controls['anspk'].setValidators(null);
              formGroupanswerlist.controls['trigger'].setErrors(null);
              formGroupanswerlist.controls['anspk'].setErrors(null);
              formGroupanswerlist.controls['trigger'].updateValueAndValidity();
              formGroupanswerlist.controls['anspk'].updateValueAndValidity();
            });

            formGroupcategory.controls['answerlist'].setValidators(null);
            formGroupcategory.controls['answerlist'].setErrors(null);
            formGroupcategory.controls['answerlist'].updateValueAndValidity();
          }
          else {
            formGroupcategory.controls['answer'].setValue(null);
            formGroupcategory.controls['answer'].setValidators(null);
            formGroupcategory.controls['answer'].setErrors(null);
            formGroupcategory.controls['answer'].updateValueAndValidity();
          }


          formGroupcategory.controls['question'].setValue(null);
          formGroupcategory.controls['chklistcomments'].setValue(null);
          formGroupcategory.controls['chcklistdoc'].setValue(null);
          formGroupcategory.controls['question'].setValidators(null);
          formGroupcategory.controls['chklistcomments'].setValidators(null);
          formGroupcategory.controls['chcklistdoc'].setValidators(null);
          formGroupcategory.controls['question'].setErrors(null);
          formGroupcategory.controls['chklistcomments'].setErrors(null);
          formGroupcategory.controls['chcklistdoc'].setErrors(null);
          formGroupcategory.controls['question'].updateValueAndValidity();
          formGroupcategory.controls['chklistcomments'].updateValueAndValidity();
          formGroupcategory.controls['chcklistdoc'].updateValueAndValidity();

          j++;
        });
        formGroup.controls['categoryname'].setValue(null);
        formGroup.controls['categorypk'].setValue(null);
        formGroup.controls['categoryname'].setErrors(null);
        formGroup.controls['categorypk'].setErrors(null);
        formGroup.controls['categorylist'].setErrors(null);
        formGroup.controls['categoryname'].setValidators(null);
        formGroup.controls['categorypk'].setValidators(null);
        formGroup.controls['categorylist'].setValidators(null);
        formGroup.controls['categoryname'].updateValueAndValidity();
        formGroup.controls['categorypk'].updateValueAndValidity();
        formGroup.controls['categorylist'].updateValueAndValidity();
        i++;
      });
    }
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

  submitfoapproval() {

    console.log(this.approveDecline)
    if (this.approveDecline.valid && this.done === false) {
      if (this.approveDecline.touched) {
        this.loader = true;
        let body = this.approveDecline.value;
        this.ivmsService.submitforapproval(body).subscribe(response => {
          if (response.data.status == 1) {
            if (this.Form.status.value == 2) {
              this.toastr.success(this.i18n("The Installation Report is Submitted for Approval."), ''), {
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

  Vehiclelist() {
    this.loader = false;
    if (this.stktype == 2) {
     
      this.router.navigate(['manageivms/ivmscentrelist']);
    }
    else{
      this.router.navigate(['/manageivms/ivmslist']);
    }
    
  }


  cancel() {

    if (this.approveDecline.touched) {
      swal({
        title: this.i18n('Do you want to cancel Uploading the Installation Report?'),
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
          this.toastr.success(this.i18n('The Installation Report submission has been cancelled.'), ''), {
            timeOut: 2000,
            closeButton: false,
          };
        }
      });
    } else {
      this.approveDecline.reset();
      this.contact = '';
      this.techinfo = ''
      this.edittechinfo = !this.edittechinfo;
      this.uploaded = false;
      this.Vehiclelist();
    }
  }
  getIfrequired(i) {
    // if (this.isopen[i] == true) {
    //   this.updatevalidation(i, true);
    //   return true;
    // }
    // this.updatevalidation(i, false);
    // return false;
  }

  toggle(i, j): void {
    
    this.isopen[i + '_' + j] = !this.isopen[i + '_' + j];

  }

  cancelchecklist(i,j):void {
     

    this.getChecklistForm(i,j).get('chklistcomments').setValue(null);
    this.getChecklistForm(i,j).get('chklistcomments').updateValueAndValidity();
    this.getChecklistForm(i,j).get('chcklistdoc').setValue(null);
    this.getChecklistForm(i,j).get('chcklistdoc').updateValueAndValidity();
    console.log(this.ChekclistDocuments[i][j])
    this.ChekclistDocuments[i][j].selectedFilesPk = Array();
    this.assesmentrepotre.triggerChange();

  }

  updatevalidation(index, value) {
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
    const formgroup = Checklistarray.controls[index] as FormGroup;

    if (formgroup) {

      // if (value == true) {
      //   formgroup.controls['chklistcomments'].setValidators([Validators.required]);
      //   formgroup.controls['chcklistdoc'].setValidators([Validators.required]);
      //   formgroup.controls['chklistcomments'].updateValueAndValidity();
      //   formgroup.controls['chcklistdoc'].updateValueAndValidity();
      //   this.loader = false;


      // }
      // else {
      //   formgroup.controls['chklistcomments'].setValue(null);
      //   formgroup.controls['chklistcomments'].setValidators(null);
      //   formgroup.controls['chcklistdoc'].setValidators(null);
      //   formgroup.controls['chklistcomments'].setErrors(null);
      //   formgroup.controls['chcklistdoc'].setErrors(null);
      //   formgroup.controls['chcklistdoc'].setValue(Array());
      //   formgroup.controls['chklistcomments'].updateValueAndValidity();
      //   formgroup.controls['chcklistdoc'].updateValueAndValidity();
      //   this.ChekclistDocuments[index].selectedFilesPk = Array();
      //   this.loader = false;
      // }

      // console.log(formgroup.controls);
    }


  }

  getChecklistForm(i,j) {
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
    const categorylistarray = Checklistarray.controls[i].get('categorylist') as FormArray;
    // const control = categorylistarray.controls[j].get('answerlist') as FormArray;

    const formgroup = categorylistarray.controls[j] as FormGroup;

    return formgroup;
  }

  getAnswerlistForm(i,j,k) {

    
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;
    const categorylistarray = Checklistarray.controls[i].get('categorylist') as FormArray;
    const control = categorylistarray.controls[j].get('answerlist') as FormArray;
    const formgroup = control.controls[k] as FormGroup;
    return formgroup;
  }

  getType() {
    if (this.activeRoute.snapshot.url[0].path == 'updatereports') {
      this.isEdit = true;
      this.getInspectionDetails();
    } else {
      this.isEdit = false;
    }

  }

  checkAllFun(value, pk) {
    this.loader = true;
    const Checklistarray = this.approveDecline.get('onlinechecklist') as FormArray;

    console.log(this.passanswrslist, this.passanswrslist[pk], this.passanswrslist[pk]?.length > 0)

    if (this.passanswrslist && this.passanswrslist[pk] && this.passanswrslist[pk]?.length > 0) {
      let i = 0;
      Checklistarray.controls.forEach((formGroup: FormGroup) => {

        if (formGroup.controls['categorypk'].value == pk) {
          const control = Checklistarray.controls[i].get('categorylist') as FormArray;
          control.controls.forEach((formGroupcategory: FormGroup) => {

            this.passanswrslist[pk].forEach(element => {
              if (element.question == formGroupcategory.controls['question'].value) {
                if (value == true) {
                  formGroupcategory.controls['answer'].setValue(element.answer);

                }
                else {
                  formGroupcategory.controls['answer'].setValue(null);

                }

                formGroupcategory.controls['answer'].updateValueAndValidity();
              }

            });


          });
        }


        i++;
      });

      this.approveDecline.markAsTouched();
      this.loader = false;

    }
    else {
      this.getAllPassanswrs(value, pk);
    }

  }

  getAllPassanswrs(value = null, pk = null) {
    this.ivmsService.getAllPassAnswersForChklist(this.security.encrypt(this.devicePk)).subscribe(res => {
      this.passanswrslist = res.data.data;

      if (value) {
        this.checkAllFun(value, pk);
      }

      console.log(this.passanswrslist)

    });


  }


    openDialog(inst,tech): void {
      const dialogRef = this.dialog.open(IvmslimitmodelComponent, {
        panelClass: 'ivmsLimitmodel',
        data: { installation:inst, technician: tech },
      });
  
      dialogRef.afterClosed().subscribe(result => {
        if(result.data == true)
        {
          this.Vehiclelist();
        }
      });
    }
}

