import { Component, Input, OnInit, ViewEncapsulation } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { RemoteService } from '@app/remote.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { TechnicalstaffService } from '@app/services/technicalStaff.service';
import { ToastrService } from 'ngx-toastr';
import { TrainingStaffService } from '@app/services/trainingStaff.service';
import swal from 'sweetalert';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { MatDialog } from '@angular/material/dialog';
import { Datepickermodal } from '@app/@shared/datepickermodal/datepickermodal';
@Component({
  selector: 'app-staffinfocard',
  templateUrl: './staffinfocard.component.html',
  styleUrls: ['./staffinfocard.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class StaffinfocardComponent implements OnInit {
  @Input('traningCentre') traningCentre: boolean;
  @Input("data") data: any;
  currentTab: any;
  public useraccess: any = '';
  public isfocalpoint: any;
  public stktype: any;
  downloadaccess: boolean = false;
  disableSubmitButton: boolean = false;
  readaccess: boolean = false;
  createaccess: boolean = false;
  updateaccess: boolean = false;
  deleteaccess: boolean = false;

  downloadaccessTech: boolean = false;
  readaccessTech: boolean = false;
  createaccessTech: boolean = false;
  updateaccessTech: boolean = false;
  deleteaccessTech: boolean = false;
  @Input("technical") technical: any
  i18n(key) {
    return this.translate.instant(key);
  }
  dummyURL = 'assets/images/opalimages/avatar.svg';
  constructor(private translate: TranslateService,
    private remoteService: RemoteService,
    public router: Router,
    public commonDialog: MatDialog,
    private technicalstaff: TechnicalstaffService,
    private trainingstaff: TrainingStaffService,
    private toastr: ToastrService,
    private localstorage: AppLocalStorageServices,
    private cookieService: CookieService,) { }

  languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
  { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
  dir = 'ltr';

  ngOnInit(): void {

    this.useraccess = this.localstorage.getInLocal('uerpermission');
    console.log(this.useraccess, 'this.useraccess');
    this.stktype = this.localstorage.getInLocal('stktype');
    this.isfocalpoint = this.localstorage.getInLocal('isfocalpoint');
    let moduleid = this.localstorage.getaccessmoduleid(this.stktype, 'Staff Management');

    if (this.isfocalpoint == 1) {
      this.downloadaccess = true;
      this.readaccess = true;
      this.createaccess = true;
      this.updateaccess = true;
      this.deleteaccess = true;

      this.downloadaccessTech = true;
      this.readaccessTech = true;
      this.createaccessTech = true;
      this.updateaccessTech = true;
      this.deleteaccessTech = true;
    }
    let submodule = this.stktype == 1 ? 32 : 38;

    if (this.isfocalpoint == 2 && this.useraccess[moduleid] != undefined) {
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].download == 'Y') {
        this.downloadaccess = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].read == 'Y') {
        this.readaccess = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].create == 'Y') {
        this.createaccess = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].update == 'Y') {
        this.updateaccess = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submodule] && this.useraccess[moduleid][submodule].delete == 'Y') {
        this.deleteaccess = true;
      }
    }

    //Technical 
    let submoduleTech = this.stktype == 1 ?  33 : 39;

    if (this.isfocalpoint == 2 && this.useraccess[moduleid] != undefined) {
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submoduleTech] && this.useraccess[moduleid][submoduleTech].download == 'Y') {
        this.downloadaccessTech = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submoduleTech] && this.useraccess[moduleid][submoduleTech].read == 'Y') {
        this.readaccessTech = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submoduleTech] && this.useraccess[moduleid][submoduleTech].create == 'Y') {
        this.createaccessTech = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submoduleTech] && this.useraccess[moduleid][submoduleTech].update == 'Y') {
        this.updateaccessTech = true;
      }
      if (this.useraccess[moduleid] && this.useraccess[moduleid][submoduleTech] && this.useraccess[moduleid][submoduleTech].delete == 'Y') {
        this.deleteaccessTech = true;
      }
    }

    // console.log(this.readaccess + 'readaccess');

    // if (this.readaccess == false) {
    //   swal({
    //     title: this.i18n("You do not have the privilege to access this module. Kindly reach out to your Organisation's Administrator for assistance."),
    //     text: '',
    //     icon: 'warning',
    //     buttons: [false, this.i18n('Ok')],
    //     dangerMode: true,
    //     className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
    //     closeOnClickOutside: false
    //   }).then((willGoBack) => {
    //     if (willGoBack) {
    //       this.router.navigate(['/dashboard/portaladmin'])
    //     }
    //   });
    // }

    this.currentTab = localStorage.getItem('typeView')
    if (this.currentTab == 'viewstaff') {
      this.currentTab = 'viewStaff';
    }

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
  }
  viewtechButton(type, id: any,course:any) {
    if (this.traningCentre == true) {
      console.log("training", this.traningCentre);
      if (type == 'viewStaff') {
        this.router.navigate(['/approvalstaffmanagement/trainingcentreview'], { queryParams: { id: btoa(id),'course': btoa(course)}  });
        localStorage.setItem('typeView', type)
      } else if (type == 'viewAvailabilty') {
        this.router.navigate(['approvalstaffmanagement/trainingavailability'], { queryParams: { id: btoa(id),'course': btoa(course)} });
        localStorage.setItem('typeView', type)
      } else if (type == 'addStaff') {
        this.router.navigate(['/standardcourse/assessoravailability/add'], { queryParams: { id: btoa(id)} });
      }
    } else {
      console.log("technical", this.technical);
      if (type == 'viewStaff') {
        this.router.navigate(['/approvalstaffmanagement/technicalstaffview'], { queryParams: { id: btoa(id) } });
        localStorage.setItem('typeView', type)
      } else if (type == 'viewAvailabilty') {
        this.router.navigate(['approvalstaffmanagement/technicalviewschedule'], { queryParams: { id: btoa(id) } });
        localStorage.setItem('typeView', type)
      }
      else if (type == 'addStaff') {
        this.router.navigate(['/standardcourse/assessoravailability/add'], { queryParams: { id: btoa(id) } });
      }
    }
  }

  // Print Competency
  printCompetency(id: any) {
    if (this.traningCentre == true) {
      this.trainingstaff.printCompCrad(id).subscribe((data: any) => {
        if (!data?.data?.attend || (data?.data?.status == false && data?.data?.attend.length === 0)) {
          this.toastr.error("Please generate competancy card!");
          return;
        } else {
          let response = data.data?.attend;
          var link = document.createElement('a');
          link.target = "_blank";
          link.href = response
          link.click();
        }
      })
    } else {
      this.technicalstaff.printCompCrad(id).subscribe((data: any) => {
        if (!data?.data?.attend || (data?.data?.status == false && data?.data?.attend.length === 0)) {
          this.toastr.error("Please generate competancy card!");
          return;
        } else {
          let response = data.data?.attend;
          var link = document.createElement('a');
          link.target = "_blank";
          link.href = response
          link.click();
        }
      })
    }
  }
  // View Competency
  viewCompetency(id: any) {
    if (this.traningCentre == true) {
      this.trainingstaff.viewCompCrad(id).subscribe((data: any) => {
        if (!data?.data?.attend || (data?.data?.status == false && data?.data?.attend.length === 0)) {
          this.toastr.error("Please generate competancy card!");
          return;
        } else {
          let response = data.data?.attend;
          var link = document.createElement('a');
          link.target = "_blank";
          link.href = response
          link.click();
        }
      })
    } else {
      this.technicalstaff.viewCompCrad(id).subscribe((data: any) => {
        if (!data?.data?.attend || (data?.data?.status == false && data?.data?.attend.length === 0)) {
          this.toastr.error("Please generate competancy card!");
          return;
        } else {
          let response = data.data?.attend;
          var link = document.createElement('a');
          link.target = "_blank";
          link.href = response
          link.click();
        }
      })
    }
  }

  // Remove from center
  removeCenter(id: any) {
    swal({
      title: this.i18n('Do you want to remove from this Centre?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.trainingstaff.removeStaffCentre(id).subscribe((data: any) => {
          if (data?.data?.status == true) {
            this.router.navigate(['/approvalstaffmanagement/trainingcentre']);
          }
          else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          }
        })
      }
    });
  }

  // download(civil: any, staffinfo: any) {
  //   this.trainingstaff.exportSingle(civil, staffinfo).subscribe((data: any) => {
  //     let response = data.data.attend;
  //     var link = document.createElement('a');
  //     link.href = response
  //     link.click();
  //   })
  // }

  // Genrate Competency
  genrateCompetency(id: any) {
    swal({
      title: this.i18n('Do you want to generate the Competency Card?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
        this.trainingstaff.genrateCompCrad(id).subscribe((data: any) => {
          this.disableSubmitButton = false;
          console.log("Data", data);
          if (data?.data?.status == true) {
            // this.toastr.success(data?.data?.message);
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'success',
              buttons: [false, 'Ok'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          } else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
            // this.toastr.warning(data?.data?.message);
          }
        })
      }
    });
  }
  openDatepickerDialog(civil:any,staffInfoTemp:any,staff:any,course:any,coursePk:any) {
    const dialogRef = this.commonDialog.open(Datepickermodal, {
      panelClass: 'availabiltyModel',
      data: {
        title: 'Select Date To Export Data',
        inputName: 'Folder Name',
        noButtonText: 'Cancel',
        submitButtonText: 'Export',
        civil: civil,
        staffInfoTemp: staffInfoTemp,
        staff: staff,
        course: course,
        coursePk: coursePk,
      }
    });
    dialogRef.afterClosed().subscribe(result => {
      this.disableSubmitButton = true;
      if(result?.civil){
        this.trainingstaff.exportSingle(result.civil, result.staffInfoTemp,result.dateRange,result.coursePk).subscribe((data: any) => {
        if(data.data.status == 3){
          swal({
            title: this.i18n("No records are available for download within the selected date range."),
            text: '',
            icon: 'warning',
            buttons: [false, this.i18n('Ok')],
            dangerMode: true,
            className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
            closeOnClickOutside: false
          }).then((willGoBack) => {
            this.disableSubmitButton = false;
          });
          return false;
        }
        let response = data.data.attend;
        var link = document.createElement('a');
        link.href = response
        link.click();
        this.disableSubmitButton = false;
        })
      }else{
        this.disableSubmitButton = false;
      }
    });
  }

  // Re-Genrate Competency
  reGenrateCompetency(id: any) {
    swal({
      title: this.i18n('Do you want to re-generate the Competency Card?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
        this.trainingstaff.reGenrateCompCrad(id).subscribe((data: any) => {
          this.disableSubmitButton = false;
          console.log("Data", data);
          if (data?.data?.status == true) {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'success',
              buttons: [false, 'Ok'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          } else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          }
        })
      }
    });
  }
  // For Technical Staff

  // Remove from center for Technical
  removeCenterTech(id: any) {
    swal({
      title: this.i18n('Do you want to remove from this Centre?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.technicalstaff.removeStaffCentre(id).subscribe((data: any) => {
          if (data?.data?.status == true) {
            this.router.navigate(['/approvalstaffmanagement/technicalcentre']);
          }
          else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          }
        })
      }
    });
  }

  // Genrate Competency for Technical
  genrateCompetencyTech(id: any) {
    swal({
      title: this.i18n('Do you want to generate the Competency Card?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
        this.technicalstaff.genrateCompCrad(id).subscribe((data: any) => {
          this.disableSubmitButton = false;
          console.log("Data", data);
          if (data?.data?.status == true) {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'success',
              buttons: [false, 'Ok'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          } else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
            // this.toastr.warning(data?.data?.message);
          }
        })
      }
    });
  }
  // Re-Genrate Competency  for Technical
  reGenrateCompetencyTech(id: any) {
    swal({
      title: this.i18n('Do you want to re-generate the Competency Card?'),
      text: '',
      icon: 'warning',
      buttons: [this.i18n('No'), this.i18n('Yes')],
      dangerMode: true,
      className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
      closeOnClickOutside: false
    }).then((willGoBack) => {
      if (willGoBack) {
        this.disableSubmitButton = true;
        this.technicalstaff.reGenrateCompCrad(id).subscribe((data: any) => {
          this.disableSubmitButton = false;
          console.log("Data", data);
          if (data?.data?.status == true) {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'success',
              buttons: [false, 'Ok'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          } else {
            swal({
              title: this.i18n(data?.data?.message),
              text: '',
              icon: 'warning',
              buttons: [false, 'OK'],
              dangerMode: true,
              className: this.dir == 'ltr' ? 'swalEng' : 'swalAr',
              closeOnClickOutside: false
            })
          }
        })
      }
    });
  }

}
