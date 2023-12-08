import {
  ChangeDetectorRef,
  Component,
  EventEmitter,
  Input,
  OnInit,
  Output,
  SimpleChanges,
  ViewChild,
} from "@angular/core";
import { MatPaginator } from "@angular/material/paginator";
import { MatDrawer } from "@angular/material/sidenav";
import { MatSort } from "@angular/material/sort";
import { MatTableDataSource } from "@angular/material/table";
import { Encrypt } from "@app/common/class/encrypt";
import { EnterpriseService } from "@app/modules/enterpriseadmin/enterprise.service";
import "rxjs/add/observable/of";
import swal from "sweetalert";
import { animate, state, style, transition, trigger } from "@angular/animations";
import { ToastrService } from "ngx-toastr";
import { FLAGS } from "html2canvas/dist/types/dom/element-container";
import { EnterpriseadminService } from "@app/modules/newenterpriseadmin/enterpriseadmin.service";
import { SlideInOutAnimation } from "@app/common/drive/animation";
// export interface ModuleElement {
//   id: number;
//   name: string;
//   create: string;
//   update: string;
//   delete: string;
//   approve: string;
//   download: string;
//   submodule?: SubmoduleElement[] | MatTableDataSource<SubmoduleElement>;
// }

// export interface SubmoduleElement {
//   sid: number;
//   sname: string;
//   screate: string;
//   supdate: string;
//   sdelete: string;
//   sapprove: string;
//   sdownload: string;
// }

// const ELEMENT_DATA: ModuleElement[] = [
//   {
//     id: 1,
//     name: "Module - 1",
//     create: "",
//     update: "",
//     delete: "",
//     approve: "",
//     download: "",
//     submodule: [
//       {
//         sid: 11,
//         sname: "SubModule - 1",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//       {
//         sid: 12,
//         sname: "SubModule - 2",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//       {
//         sid: 13,
//         sname: "SubModule - 3",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//     ],
//   },
//   {
//     id: 2,
//     name: "Module - 2",
//     create: "",
//     update: "",
//     delete: "",
//     approve: "",
//     download: "",
//     submodule: [
//       {
//         sid: 21,
//         sname: "SubModule - 5",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//       {
//         sid: 22,
//         sname: "SubModule - 6",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//       {
//         sid: 23,
//         sname: "SubModule - 7",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//     ],
//   },
//   {
//     id: 3,
//     name: "Module - 3",
//     create: "",
//     update: "",
//     delete: "",
//     approve: "",
//     download: "",
//     submodule: [
//       {
//         sid: 31,
//         sname: "SubModule - 7",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//       {
//         sid: 32,
//         sname: "SubModule - 8",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//     ],
//   },
//   {
//     id: 4,
//     name: "Module - 4",
//     create: "",
//     update: "",
//     delete: "",
//     approve: "",
//     download: "",
//     submodule: [
//       {
//         sid: 41,
//         sname: "SubModule - 9",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//       {
//         sid: 42,
//         sname: "SubModule - 10",
//         screate: "",
//         supdate: "",
//         sdelete: "",
//         sapprove: "",
//         sdownload: "",
//       },
//     ],
//   },
// ];
@Component({
  selector: "app-userallocation",
  templateUrl: "./userallocation.component.html",
  styleUrls: ["./userallocation.component.scss"],
  animations: [
    trigger("detailExpand", [
      state("collapsed", style({ height: "0px", minHeight: "0", visibility: "hidden" })),
      state("expanded", style({ height: "*", visibility: "visible" })),
      transition("expanded <=> collapsed", animate("225ms cubic-bezier(0.4, 0.0, 0.2, 1)")),
    ]),
    SlideInOutAnimation,
  ],
})
export class UserallocationComponent implements OnInit {
  public basicdata: any;
  @Output("showLoader") showLoader: any = new EventEmitter<any>();
  @Output("showLoaderpermission") showLoaderpermission: any = new EventEmitter<any>();
  @Input("noteText") noteText: any;
  @Input() tog: any = "";
  columnsToDisplay = ["name", "create", "update", "delete", "approve", "download"];
  innerDisplayedColumns = ["sname", "screate", "supdate", "sdelete", "sapprove", "sdownload"];
  // dataSource = ELEMENT_DATA;
  dataSourceforpermission: any = [];
  permissionarray: any;
  finalpermissionarray: any = [];
  @Input("draweruserallocation") draweruserallocation: MatDrawer;
  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;
  @Input("toggleOnClose") toggleOnClose: boolean = true;
  public moduleIdsArr: any = [];
  public modulepersArr: any = [];
  checked = true;
  indeterminate = false;
  public Ucontentplaceloader = false;
  labelPosition = "after";
  disabled = false;
  submitted = false;
  usersubmitted = false;
  public postParams: any;
  public postUrl: any;
  @Output() userPermData: any = new EventEmitter<any>();
  public userName: any = "-";
  public designation: any = "-";
  public swalData: any;
  public englishbtn = false;
  public arabicbtn = true;
  @Input() currentUserPk: any = "";
  @Input() stkpk: number;
  @Input() onlyview: number = 2;
  @Input() requestbtnhide: boolean = false;
  @Input() viewRoleUserdis: boolean = false;

  @Input() enableform: boolean = true;
  checkedCount: number = 0;
  countOFChecked: number = 0;
  finalpermissiontemparray: any[] = [];
  finalpermissiontempinitialarray: any[] = [];
  addUpdateBtnDisable: boolean = true;
  constructor(
    private enterprise: EnterpriseadminService,
    private cdr: ChangeDetectorRef,
    private encrypt: Encrypt,
    public toastr: ToastrService
  ) { }

  isExtendedRow = (index, item) => item.extend;
  ngOnInit() {
    //debugger
  }
  ngOnChanges(changes: SimpleChanges): void {
    setTimeout(() => {
      this.initialDetailsFetch();
    }, 2600);
    
    //debugger;
  }
  checkAddUserAllocationEquals() {
    return JSON.stringify(this.finalpermissiontemparray) == JSON.stringify(this.finalpermissiontempinitialarray);
  }
  // Edit Module Permission Settings
  checkUserAllocationEquals() {
    if (this.finalpermissiontemparray.length == 0) {
      return true;
    }
    if (this.finalpermissionarray.length > 0) {
      this.finalpermissiontempinitialarray = this.finalpermissionarray;
    }
    return JSON.stringify(this.finalpermissiontemparray) == JSON.stringify(this.finalpermissiontempinitialarray);
  }
  closeUserAllocation() {
    if (this.currentUserPk == 0 || this.currentUserPk == "") {
      if (this.checkedCount != 0 && this.countOFChecked != 0 && !this.checkAddUserAllocationEquals()) {
        swal({
          title: "Do you want to cancel creating this Module Permission Settings for the User?",
          text: "If yes, any unsaved data will be lost.",
          icon: "warning",
          buttons: ["No", "Yes"],
          dangerMode: true,
          closeOnClickOutside: false,
          closeOnEsc: false,
        }).then((willDelete) => {
          if (willDelete) {
            if (this.toggleOnClose) {
              this.finalpermissiontempinitialarray = [];
              this.finalpermissiontemparray = [];
              this.fullMOduleCheck();
              if (this.finalpermissionarray.length > 0) {
                this.addUpdateBtnDisable = true;
                this.checkedCount = 0;
                this.countOFChecked = 0;
                this.finalpermissionarray.forEach((element) => {
                  this.toggleRow1(element.module);
                });
              }
            }
            this.draweruserallocation.toggle();
          }
        });
      } else {
        this.draweruserallocation.toggle();
      }
    } else if (this.currentUserPk > 0) {
      if (this.checkUserAllocationEquals()) {
        this.draweruserallocation.toggle();
      } else {
        swal({
          title: "Do you want to cancel updating this Module Permission Settings for the User?",
          text: "If yes, any unsaved data will be lost.",
          icon: "warning",
          buttons: ["No", "Yes"],
          dangerMode: true,
          closeOnClickOutside: false,
          closeOnEsc: false,
        }).then((willDelete) => {
          if (willDelete) {
            if (this.toggleOnClose) {
              // this.addUpdateBtnDisable = true;
              this.checkedCount = 0;
              this.countOFChecked = 0;
              this.finalpermissiontempinitialarray = [];
              this.finalpermissiontemparray = [];
              if (this.finalpermissionarray.length > 0) {
                this.fullMOduleCheck();
                this.finalpermissionarray.forEach((element) => {
                  this.toggleRow1(element.module);
                });
              }

              this.draweruserallocation.toggle();
            }
          }
        });
      }
    } else {
      this.draweruserallocation.toggle();
    }
    this.animationState3 = "out";
    let modArr = this.moduleIdsArr;
    let convertArr = Object.keys(modArr).map(function (key) {
      return [modArr[key]];
    });

    let convertModArr = Object.keys(modArr).map(function (key) {
      return [key];
    });
    (<HTMLInputElement>document.getElementById("allexcl")).setAttribute("data-label", "fa-plus");
    (<HTMLInputElement>document.getElementById("allexcl")).classList.remove("fa-minus");
    (<HTMLInputElement>document.getElementById("allexcl")).classList.add("fa-plus");
    convertModArr.forEach((index) => {
      (<HTMLInputElement>(
        document.getElementById(this.onlyview + "_sh_" + index)
      )).parentElement.parentElement.classList.remove("activeParent");
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + index)).setAttribute("data-label", "fa-plus");
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + index)).classList.remove("fa-minus");
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + index)).classList.add("fa-plus");
    });
    convertArr.forEach((subModArr, mainIndex) => {
      subModArr[0].forEach((item, subIndex) => {
        (<HTMLInputElement>(
          document.getElementById(this.onlyview + "_sh_" + item + "_0")
        )).parentElement.parentElement.classList.add("rowCollapse");
        (<HTMLInputElement>(
          document.getElementById(this.onlyview + "_sh_" + item + "_0")
        )).parentElement.parentElement.classList.remove("rowExpand");
      });
    });
  }

  public scrollTo(className: string): void {
    try {
      const elementList = document.querySelectorAll("." + className);
      const element = elementList[0] as HTMLElement;
      element.scrollIntoView({ behavior: "smooth" });
    } catch (error) { }
  }
  savemodulepermissionallocation() {
    this.cdr.detectChanges();

    const moduleForm = <HTMLFormElement>document.getElementById("modulecheckform");
    const formdata = new FormData(moduleForm);
    const permissionarray = [];

    formdata.forEach((item, index) => {
      const splitdata = index.split("_");
      const typeofoperation = typeof splitdata[3] != "undefined" ? splitdata[3] : "All";
      const submoduleoperation = typeof splitdata[2] != "undefined" ? splitdata[2] : "All";
      const mainmoduleoperation = typeof splitdata[1] != "undefined" ? splitdata[1] : "All";
      const booleanvalue = 1;
      const permissionobj = {
        name: index,
        value: booleanvalue,
        module: mainmoduleoperation,
        submodule: submoduleoperation,
        type: typeofoperation,
      };
      permissionarray.push(permissionobj);
    });
    if (permissionarray.length > 0) {
      this.finalpermissionarray = permissionarray;
      this.userPermData.emit(permissionarray);
      this.checkedCount = 0;
      this.countOFChecked = 0;
    } else {
      this.userPermData.emit(permissionarray);
    }
  }
  animationState = "out";
  animationState1 = "out";
  animationState2 = "out";
  animationState3 = "out";

  toggle() {
    this.tog.toggle();
  }

  toggleShowDiv(divName: string) {
    if (divName === "descriptioncontent") {
      this.animationState = this.animationState === "out" ? "in" : "out";
    } else if (divName === "documentinformationanimate") {
      this.animationState1 = this.animationState1 === "out" ? "in" : "out";
    } else if (divName === "coc") {
      this.animationState2 = this.animationState2 === "out" ? "in" : "out";
    } else if (divName === "userroleallocation") {
      this.animationState3 = this.animationState3 === "out" ? "in" : "out";
    }
  }
  toggleRowall() {
    let modArr = this.moduleIdsArr;
    let convertArr = Object.keys(modArr).map(function (key) {
      return [modArr[key]];
    });

    let convertModArr = Object.keys(modArr).map(function (key) {
      return [key];
    });
    convertArr.forEach((subModArr, mainIndex) => {
      subModArr[0].forEach((item, subIndex) => {
        for (let i = 1; i <= 6; i++) { }
      });
    });
    if ((<HTMLInputElement>document.getElementById("allexcl")).getAttribute("data-label") == "fa-plus") {
      (<HTMLInputElement>document.getElementById("allexcl")).setAttribute("data-label", "fa-minus");
      (<HTMLInputElement>document.getElementById("allexcl")).classList.remove("fa-plus");
      (<HTMLInputElement>document.getElementById("allexcl")).classList.add("fa-minus");
      convertModArr.forEach((index) => {
        (<HTMLInputElement>(
          document.getElementById(this.onlyview + "_sh_" + index)
        )).parentElement.parentElement.classList.add("activeParent");
        (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + index)).setAttribute(
          "data-label",
          "fa-minus"
        );
        (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + index)).classList.remove("fa-plus");
        (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + index)).classList.add("fa-minus");
      });
      convertArr.forEach((subModArr, mainIndex) => {
        subModArr[0].forEach((item, subIndex) => {
          (<HTMLInputElement>(
            document.getElementById(this.onlyview + "_sh_" + item + "_0")
          )).parentElement.parentElement.classList.remove("rowCollapse");
          (<HTMLInputElement>(
            document.getElementById(this.onlyview + "_sh_" + item + "_0")
          )).parentElement.parentElement.classList.add("rowExpand");
        });
      });
    } else {
      (<HTMLInputElement>document.getElementById("allexcl")).setAttribute("data-label", "fa-plus");
      (<HTMLInputElement>document.getElementById("allexcl")).classList.remove("fa-minus");
      (<HTMLInputElement>document.getElementById("allexcl")).classList.add("fa-plus");
      convertModArr.forEach((index) => {
        (<HTMLInputElement>(
          document.getElementById(this.onlyview + "_sh_" + index)
        )).parentElement.parentElement.classList.remove("activeParent");
        (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + index)).setAttribute(
          "data-label",
          "fa-plus"
        );
        (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + index)).classList.remove("fa-minus");
        (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + index)).classList.add("fa-plus");
      });
      convertArr.forEach((subModArr, mainIndex) => {
        subModArr[0].forEach((item, subIndex) => {
          (<HTMLInputElement>(
            document.getElementById(this.onlyview + "_sh_" + item + "_0")
          )).parentElement.parentElement.classList.add("rowCollapse");
          (<HTMLInputElement>(
            document.getElementById(this.onlyview + "_sh_" + item + "_0")
          )).parentElement.parentElement.classList.remove("rowExpand");
        });
      });
    }
  }
  toggleRow(event, module_id) {
    if (
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + module_id)).getAttribute("data-label") ==
      "fa-plus"
    ) {
      //alert("togglerow if condition" +  this.onlyview+"_sh_" + module_id);
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + module_id)).setAttribute(
        "data-label",
        "fa-minus"
      );
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + module_id)).classList.remove("fa-plus");
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + module_id)).classList.add("fa-minus");
      (<HTMLInputElement>(
        document.getElementById(this.onlyview + "_sh_" + module_id)
      )).parentElement.parentElement.classList.add("activeParent");
      //alert(JSON.stringify(this.moduleIdsArr[module_id]));
      this.moduleIdsArr[module_id].forEach((item, index) => {
        if (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + item + "_0")) {
          (<HTMLInputElement>(
            document.getElementById(this.onlyview + "_sh_" + item + "_0")
          )).parentElement.parentElement.classList.remove("rowCollapse");
          (<HTMLInputElement>(
            document.getElementById(this.onlyview + "_sh_" + item + "_0")
          )).parentElement.parentElement.classList.add("rowExpand");
        }
      });
    } else {
      //alert("togglerow else condition");
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + module_id)).setAttribute(
        "data-label",
        "fa-plus"
      );
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + module_id)).classList.remove("fa-minus");
      (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + module_id)).classList.add("fa-plus");
      (<HTMLInputElement>(
        document.getElementById(this.onlyview + "_sh_" + module_id)
      )).parentElement.parentElement.classList.remove("activeParent");
      this.moduleIdsArr[module_id].forEach((item, index) => {
        if (<HTMLInputElement>document.getElementById(this.onlyview + "_sh_" + item + "_0")) {
          (<HTMLInputElement>(
            document.getElementById(this.onlyview + "_sh_" + item + "_0")
          )).parentElement.parentElement.classList.add("rowCollapse");
          (<HTMLInputElement>(
            document.getElementById(this.onlyview + "_sh_" + item + "_0")
          )).parentElement.parentElement.classList.remove("rowExpand");
        }
      });
    }
  }
  toggleRow1(moduleId) {
    this.moduleIdsArr[moduleId].forEach((item, index) => {
      for (let i = 1; i <= 6; i++) {
        if (<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + i)) {
          (<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + i)).checked = true;
        }
        if (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)) {
          (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)).checked = true;
        }
        if (<HTMLInputElement>document.getElementById("module_" + moduleId)) {
          (<HTMLInputElement>document.getElementById("module_" + moduleId)).checked = true;
        }
      }
    });
  }
  moduleToggle(event, module_id, accessType) {
    if (event.target.checked == true) {
      let activeReadCnt = 0;
      let totalCnt = 0;
      let modulecheckcount = 0;
      let totalmodulecnt = 0;
      this.moduleIdsArr[module_id].forEach((item, index) => {
        totalCnt = totalCnt + 1;
        if (<HTMLInputElement>document.getElementById("module_" + item + "_" + accessType)) {
          (<HTMLInputElement>document.getElementById("module_" + item + "_" + accessType)).checked = true;
        }

        if (<HTMLInputElement>document.getElementById("module_" + item + "_2")) {
          (<HTMLInputElement>document.getElementById("module_" + item + "_2")).checked = true;
          activeReadCnt = activeReadCnt + 1;
        }
      });

      if (activeReadCnt == totalCnt) {
        if (<HTMLInputElement>document.getElementById("mm-" + module_id + "-2")) {
          //var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+module_id+'-2');
          //tgleReadChked.classList.add("mat-checked");
          (<HTMLInputElement>document.getElementById("mm-" + module_id + "-2")).checked = true;
        }
      }

      for(let i=1; i<=6;i++){
        if((<HTMLInputElement>document.getElementById("mm-" + module_id + "-"+i))?.checked && (<HTMLInputElement>document.getElementById("mm-" + module_id + "-"+i)).checked == true){
          modulecheckcount = modulecheckcount + 1 ;
        }

        if((<HTMLInputElement>document.getElementById("mm-" + module_id + "-"+i))){
          totalmodulecnt = totalmodulecnt + 1 ;
        }
                   
      }
      
      if(totalmodulecnt == modulecheckcount)
      {
        setTimeout(() => {
          (<HTMLInputElement>document.getElementById('module_'+ module_id)).checked = true;
           console.log('module_'+module_id);
        }, 300);
         
      }
    } else {
      this.moduleIdsArr[module_id].forEach((item, index) => {
        if (<HTMLInputElement>document.getElementById("module_" + item + "_" + accessType)) {
          (<HTMLInputElement>document.getElementById("module_" + item + "_" + accessType)).checked = false;
        }
        if (accessType == 2) {
          for (let i = 1; i <= 6; i++) {
            if (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)) {
              (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)).checked = false;
            }
            if (<HTMLInputElement>document.getElementById("mm-" + module_id + "-" + i)) {
              //var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+module_id+'-'+i);
              //tgleReadChked.classList.remove("mat-checked");
              (<HTMLInputElement>document.getElementById("mm-" + module_id + "-" + i)).checked = false;
            }
          }
        }
      });
    }
    var inputElements = [].slice.call(document.querySelectorAll(".selval_" + module_id));
    var checkedValue = inputElements.filter((chk) => chk.checked).length;
    var count = inputElements.filter((chk) => chk).length;
    if (checkedValue == count) {
      (<HTMLInputElement>document.getElementById("module_" + module_id)).checked = true;
    } else {
      (<HTMLInputElement>document.getElementById("module_" + module_id)).checked = false;
    }
    this.savemodulepermissionallocation();
  }

  checkBoxCheck(event, module_id, accessType) {
    let splitModule = module_id.split("_");
    let activeCnt = 0;
    let activeReadCnt = 0;
    let totalCnt = 0;
    if (event.target.checked == true) {
      if (<HTMLInputElement>document.getElementById("module_" + module_id + "_2")) {
        (<HTMLInputElement>document.getElementById("module_" + module_id + "_2")).checked = true;
      }

      this.moduleIdsArr[splitModule[0]].forEach((item, index) => {
        if (<HTMLInputElement>document.getElementById("module_" + item + "_" + accessType)) {
          totalCnt = totalCnt + 1;
          if ((<HTMLInputElement>document.getElementById("module_" + item + "_" + accessType)).checked == true) {
            activeCnt = activeCnt + 1;
          }
        }
        if (<HTMLInputElement>document.getElementById("module_" + item + "_2")) {
          if ((<HTMLInputElement>document.getElementById("module_" + item + "_2")).checked == true) {
            activeReadCnt = activeReadCnt + 1;
          }
        }
      });
      if (activeCnt == totalCnt) {
        //var tgle = <HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-'+accessType);
        //var tgleReadChecked = <HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2');
        //tgleReadChecked.classList.add("mat-checked");
        //(<HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2')).checked = true;
        (<HTMLInputElement>document.getElementById("mm-" + splitModule[0] + "-" + accessType)).checked = true;
      } else {
        //(<HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2')).checked = false;
        (<HTMLInputElement>document.getElementById("mm-" + splitModule[0] + "-" + accessType)).checked = false;
      }
      /*  if(activeReadCnt == totalCnt){
         var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2');
         tgleReadChked.classList.add("mat-checked");
       } */
    } else {
      //const enToggle = (<HTMLInputElement>document.getElementById("mm-"+splitModule[0]+"-"+accessType));
      //enToggle.classList.remove("mat-checked");
      if (<HTMLInputElement>document.getElementById("mm-" + splitModule[0] + "-" + accessType)) {
        (<HTMLInputElement>document.getElementById("mm-" + splitModule[0] + "-" + accessType)).checked = false;
      }
      if (accessType == 2) {
        this.moduleIdsArr[splitModule[0]].forEach((item, index) => {
          if (module_id == item) {
            for (let i = 1; i <= 6; i++) {
              if (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)) {
                (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)).checked = false;
                (<HTMLInputElement>document.getElementById("mm-" + splitModule[0] + "-" + i)).checked = false;
              }
              //const allToggle = (<HTMLInputElement>document.getElementById("mm-"+splitModule[0]+"-"+i));
              //allToggle.classList.remove("mat-checked");
            }
          }
        });
      }
    }
    var inputElements = [].slice.call(document.querySelectorAll(".selval_" + splitModule[0]));
    var checkedValue = inputElements.filter((chk) => chk.checked).length;
    var count = inputElements.filter((chk) => chk).length;
    if (checkedValue == count) {
      (<HTMLInputElement>document.getElementById("module_" + splitModule[0])).checked = true;
    } else {
      (<HTMLInputElement>document.getElementById("module_" + splitModule[0])).checked = false;
    }
    this.savemodulepermissionallocation();
  }

  fullMOduleCheck() {
    let modArr = this.moduleIdsArr;
    this.checkedCount = 0;
    this.countOFChecked = 0;
    this.addUpdateBtnDisable = true;
    let convertArr = Object.keys(modArr).map(function (key) {
      return [modArr[key]];
    });

    let convertModArr = Object.keys(modArr).map(function (key) {
      return [key];
    });
    /* if(event.target.checked== true){ */
    convertArr.forEach((subModArr, mainIndex) => {
      subModArr[0].forEach((item, subIndex) => {
        for (let i = 1; i <= 6; i++) {
          if (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)) {
            (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)).checked = false;
          }
        }
      });
    });

    convertModArr.forEach((index) => {
      for (let i = 1; i <= 6; i++) {
        if (<HTMLInputElement>document.getElementById("mm-" + index + "-" + i)) {
          var tgleReadChked = ((<HTMLInputElement>document.getElementById("mm-" + index + "-" + i)).checked = false);
        }
      }
      if (<HTMLInputElement>document.getElementById("module_" + index)) {
        (<HTMLInputElement>document.getElementById("module_" + index)).checked = false;
      }
    });
  }

  checkAllModule(event, moduleId) {

    if (event.target.checked == true) {
      this.addUpdateBtnDisable = false;
      this.checkedCount = this.checkedCount + 1;
      this.moduleIdsArr[moduleId].forEach((item, index) => {
        for (let i = 1; i <= 6; i++) {
          //var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+i);
          //tgleReadChked.classList.add("mat-checked");
          if (<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + i)) {
            (<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + i)).checked = true;
          }
          if (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)) {
            (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)).checked = true;
          }
        }
      });
    } else {
      this.checkedCount -= 1;
      this.moduleIdsArr[moduleId].forEach((item, index) => {
        for (let i = 1; i <= 6; i++) {
          /*  var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+i);
             tgleReadChked.classList.remove("mat-checked"); */
          if (<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + i)) {
            (<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + i)).checked = false;
          }
          if (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)) {
            (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)).checked = false;
          }
        }
      });
    }
    this.finalpermissiontemparray = this.createModuleFormData();

    let countChecked = false;
    this.moduleIdsArr[moduleId].forEach((item, index) => {
      countChecked = false;
      for (let ic = 1; ic <= 6; ic++) {
        if (<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + ic)) {
          if ((<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + ic)).checked) {
            countChecked = true;
          }
        }
      }
      if (countChecked) {
        this.countOFChecked++;
      } else {
        this.countOFChecked--;
      }
    });

    let checkupdatecount = 0;
    for (let ic = 1; ic <= 6; ic++) {
      if (<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + ic)) {
        if ((<HTMLInputElement>document.getElementById("mm-" + moduleId + "-" + ic)).checked) {
          checkupdatecount++;
        }
      }
    }

    if (this.currentUserPk > 0) {
      if (this.checkUserAllocationEquals()) {
        this.addUpdateBtnDisable = true;
      } else {
        this.addUpdateBtnDisable = false;
      }
    } else {
      if (
        this.checkedCount == 0 &&
        this.countOFChecked == 0 &&
        checkupdatecount == 0 &&
        this.checkAddUserAllocationEquals()
      ) {
        this.addUpdateBtnDisable = true;
      } else {
        this.addUpdateBtnDisable = false;
      }
    }
    this.savemodulepermissionallocation();
  }
  datadet: any;
  createModuleFormData() {
    const moduleForm = <HTMLFormElement>document.getElementById("modulecheckform");
    const formdata = new FormData(moduleForm);
    const permissionarray = [];

    formdata.forEach((item, index) => {
      const splitdata = index.split("_");
      const typeofoperation = typeof splitdata[3] != "undefined" ? splitdata[3] : "All";
      const submoduleoperation = typeof splitdata[2] != "undefined" ? splitdata[2] : "All";
      const mainmoduleoperation = typeof splitdata[1] != "undefined" ? splitdata[1] : "All";
      const booleanvalue = 1;
      const permissionobj = {
        name: index,
        value: booleanvalue,
        module: mainmoduleoperation,
        submodule: submoduleoperation,
        type: typeofoperation,
      };
      permissionarray.push(permissionobj);
    });
    let finalpermissiontemparr = [];
    if (permissionarray.length > 0) {
      finalpermissiontemparr = permissionarray;
    }

    return finalpermissiontemparr;
  }
  //@Output() stkUpdate = new EventEmitter(null);

  showTSuccess(data) {
    this.toastr.success(data, "", {
      timeOut: 10000,
      closeButton: true,
    });
  }
  showWSuccess(data) {
    this.toastr.warning(data, "Warning !", {
      timeOut: 10000,
      closeButton: true,
    });
  }
  removeLoader() {
    this.Ucontentplaceloader = false;
  }

  viewpermissiondata(deptChange = "") {
    this.cdr.detectChanges();
    const moduleForm = <HTMLFormElement>document.getElementById("modulecheckform");
    const formdata = new FormData(moduleForm);
    const permissionarray = [];
    formdata.forEach((item, index) => {
      const splitdata = index.split("_");
      const typeofoperation = typeof splitdata[3] != "undefined" ? splitdata[3] : "All";
      const submoduleoperation = typeof splitdata[2] != "undefined" ? splitdata[2] : "All";
      const mainmoduleoperation = typeof splitdata[1] != "undefined" ? splitdata[1] : "All";
      const booleanvalue = 1;
      const permissionobj = {
        name: index,
        value: booleanvalue,
        module: mainmoduleoperation,
        submodule: submoduleoperation,
        type: typeofoperation,
      };
      permissionarray.push(permissionobj);
    });
    if (permissionarray.length > 0) {
      this.finalpermissionarray = permissionarray;
      this.userPermData.emit(permissionarray);
      if (deptChange == "" && this.toggleOnClose) {
        // this.draweruserallocation.toggle();
      }
    }
  }

  allocationUSerDetails(fName, lName, Designation) {
    this.userName = fName + " " + lName;
    this.designation = Designation;
  }

  emptyUserNameandRole() {
    this.userName = "";
    this.designation = "";
  }

  usedatamoduleaccess(userDetails) {
    this.basicdata = userDetails;
  }
  sweetalert(data) {
    swal({
      title: data.msg,
      icon: data.status,
    }).then((value) => { });
  }

  clearModules() {
    let modArr = this.moduleIdsArr;
    let convertArr = Object.keys(modArr).map(function (key) {
      return [modArr[key]];
    });

    let convertModArr = Object.keys(modArr).map(function (key) {
      return [key];
    });

    // (<HTMLInputElement>document.getElementById("alldataselected")).checked = false;

    convertArr.forEach((subModArr, mainIndex) => {
      subModArr[0].forEach((item, subIndex) => {
        for (let i = 1; i <= 6; i++) {
          var tgleReadChked = <HTMLInputElement>document.getElementById("mm-" + item + "-" + i);
          // tgleReadChked.classList.remove("mat-checked");

          if (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)) {
            (<HTMLInputElement>document.getElementById("module_" + item + "_" + i)).checked = false;
          }
        }
      });
    });
    convertModArr.forEach((index) => {
      for (let i = 1; i <= 6; i++) {
        var tgleReadChked = <HTMLInputElement>document.getElementById("mm-" + index + "-" + i);
        // tgleReadChked.classList.remove("mat-checked");
      }
      if (<HTMLInputElement>document.getElementById("module_" + index)) {
        (<HTMLInputElement>document.getElementById("module_" + index)).checked = false;
      }
    });
  }
  userAccessModification(datadet) {
    this.datadet = datadet?.baseModulesAccess;
    this.dataSourceforpermission = new MatTableDataSource(datadet?.baseModulesAccess);
    this.moduleIdsArr = datadet?.modSubModIds
    this.Ucontentplaceloader = false;
    this.finalpermissiontemparray = [];
    this.finalpermissiontempinitialarray = [];
    this.finalpermissiontempinitialarray = this.createModuleFormData();
    if (this.currentUserPk > 0) {
      if (this.checkUserAllocationEquals()) {
        this.addUpdateBtnDisable = true;
      } else {
        this.addUpdateBtnDisable = false;
      }
    }
  }

  initialDetailsFetch() {
    if (this.dataSourceforpermission?.length == 0) {
      this.postParams = {
        "stkpk": this.stkpk,
      };
      this.postUrl = "ea/enterpriseadmin/fetch-user-details";
      this.enterprise.enterpriseService(this.postParams, this.postUrl).subscribe(
        function (data) {
          if (data["data"].status == 0) {
            // this.data.baseModules.module_id
            swal({
              title: "Warning",
              text: data["data"].msg,
              icon: "warning",
            });
          } else {
            // below is not for module permission setting panel
            this.dataSourceforpermission = new MatTableDataSource(data["data"].data.baseModules);

            this.moduleIdsArr = data["data"].data.modSubModIds;
            this.Ucontentplaceloader = false;
          }
        }.bind(this)
      );
    }
  }
  getuseraccess(stkpk) {
    this.stkpk = stkpk;
    this.postParams = {
      "stkpk": this.stkpk == 3 ? 2 : this.stkpk,
    };
    this.postUrl = "ea/enterpriseadmin/fetch-user-details";
    this.enterprise.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data["data"].status == 0) {
          // this.data.baseModules.module_id
          swal({
            title: "Warning",
            text: data["data"].msg,
            icon: "warning",
          });
        } else {
          // below is not for module permission setting panel
          this.dataSourceforpermission = new MatTableDataSource(data["data"].data.baseModules);
          this.moduleIdsArr = data["data"].data.modSubModIds;
          this.Ucontentplaceloader = false;
        }
      }.bind(this)
    );
  }
  userAccessview(datadet) {
    this.postParams = {};
    this.postUrl = "ea/enterpriseadmin/fetch-user-details";
    this.enterprise.enterpriseService(this.postParams, this.postUrl).subscribe(
      function (data) {
        if (data["data"].status == 0) {
          swal({
            title: "Warning",
            text: data["data"].msg,
            icon: "warning",
          });
          this.showLoader.emit(false);
        } else {
          if (data.status == 200) {
            this.dataSourceforpermission = new MatTableDataSource(datadet);
            this.moduleIdsArr = data["data"].data.modSubModIds;
            this.viewpermissiondata("1");
            this.showLoader.emit(false);
            this.showLoaderpermission.emit(false);
            this.Ucontentplaceloader = false;
          }
        }
      }.bind(this)
    );
  }
  readarabic() {
    this.englishbtn = true;
    this.arabicbtn = false;
  }
  readengligh() {
    this.englishbtn = false;
    this.arabicbtn = true;
  }
}