import { Component, OnInit, ViewChild, ChangeDetectorRef, HostListener } from '@angular/core';
import { MatDrawer, MatTableDataSource, MatPaginator, MatSort, PageEvent } from '@angular/material';
import { FormBuilder, FormGroup, FormControl, Validators } from '@angular/forms';
import { atLeastOne } from '@lypis_config/directives/atleastone';

/* mostly required imports */
import swal from 'sweetalert';
import { environment } from '../../../../../../environments/environment';
import { SelectionModel } from '@angular/cdk/collections';

import { EnterpriseService } from '@lypis_core/enterpriseadmin/enterprise.service';
import { CreatemenuComponent } from "../createmenu/createmenu.component";
import { Encrypt } from '@lypis_config/common/class/encrypt';
interface Stktype {
    value: string;
    viewValue: string;
}
interface Menutype {
    value: string;
    viewValue: string;
}
@Component({
    selector: 'app-managemenu',
    templateUrl: './managemenu.component.html',
    styleUrls: ['./managemenu.component.scss']
})
export class ManagemenuComponent implements OnInit {

    warnUserBeforeLeavingPage = true;
    @HostListener("window:beforeunload", ["$event"]) unloadHandler(event: Event) {
        if (this.warnUserBeforeLeavingPage) {
        event.returnValue = false;
        }
    }

    menuTypes = new FormControl();
    public menuType:any = [
        {'typeValue':'L','typeName':'Left'},
        {'typeValue':'R','typeName':'Right'},
        {'typeValue':'T','typeName':'Top'},
        {'typeValue':'B','typeName':'Bottom'}
      ];

    stktypes: Stktype[] = [
        { value: 'type-0', viewValue: 'Stakeholder Type 1' },
        { value: 'type-1', viewValue: 'Stakeholder Type 2' },
        { value: 'type-2', viewValue: 'Stakeholder Type 3' }
    ];
    public enabled;
    public editid: number = 0;
    @ViewChild(MatDrawer) drawer: any;
    createbutton: boolean = true;
    updatebutton: boolean = false;
    searchfilter: boolean = false;
    pageEvent: any;

    roleid = null;
    resultsLength = 0;
    perpage = 10;
    isRateLimitReached = false;
    displayedColumns = ['checkall', 'menuName', 'subMenuName', 'moduleName', 'menuUrl', 'menuOrder', 'stakeholderType', 'menuType', 'menuStatus', 'actionsColumn'];
    displayNoRecords: boolean;
    dataSource = new MatTableDataSource();
    public showFilter = 'Show Filter';
    public moduleName = '';
    public subModuleName = '';
    public stkholderType = '';
    public menuName = '';
    public querystr = '';
    public formParms: any;
    public status = '';
    public type = '';
    public rootModuleList: any;
    public accessList: any;
    public accessListTemp: any;
    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;
    @ViewChild('createMenu') createMenu:CreatemenuComponent;

    /*Sar*/
    public postParams:any;
    public postUrl:any;
    public stakeholderType:any = [];

    public menuValues:any = {
        'L':'Left','R':'Right','T':'Top','B':'Bottom'
    };

    constructor(
        private fb: FormBuilder,
        private changeDetector: ChangeDetectorRef,
        private enterpriseService:EnterpriseService,
        private encrypt: Encrypt,
    ) { }

    ngOnInit() {
        this.postParams = {};
        this.menuListData(this.postParams);
        this.initializeSearch();
    }

    initializeSearch(){
        this.postParams = {};
        this.postUrl = 'acm/stkholderaccessmaster/getstkholdertypes?uac=f9d6c6ad2e0f8bfded8c4c37e4140629';
        this.enterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
        function(data){
            if(data.status == 200){
            this.stakeholderType = data.data;
            }
        }.bind(this)
        );
    }

    menuListData(postParams){
        this.postUrl = 'mst/menumaster/get-menu-list';
        this.enterpriseService.enterpriseService(postParams,this.postUrl).subscribe(
            function(data){
                if(data.status == 200){
                    this.dataSource.data = data['data'].data;
                    this.resultsLength = data['data'].totalcount;
                }
            }.bind(this)
        );
    }

    syncPrimaryPaginator(event: PageEvent) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.paginator.page.emit(event);
    }

    searchiconclick() {
        this.searchfilter = !this.searchfilter;
        this.showFilter = this.searchfilter ? 'Hide Filter' : 'Show Filter';
    }
    /* FILTER FORM FIELD GROUPING */
    filterform = new FormGroup({
        stkholderType: new FormControl(''),
        menuName: new FormControl(''),
        moduleName: new FormControl(''),
        status: new FormControl(''),
        menuType: new FormControl(''),
    }, { validators: atLeastOne(Validators.required) });

    /* FILTER FORM SUBMIT METHOD */
    onFilterSubmit() {
        this.postParams = {
            'size': this.perpage,
            'page': 0,
            'stkholderType':this.filterform.controls['stkholderType'].value,
            'menuName':this.filterform.controls['menuName'].value,
            'moduleName':this.filterform.controls['moduleName'].value,
            'status':this.filterform.controls['status'].value,
            'menuType':this.filterform.controls['menuType'].value
            //'menuTypes':this.menuTypes.value
        };
        this.menuListData(this.postParams);
    }
    reloadTree() {

        this.enabled = false;
        this.changeDetector.detectChanges();
        this.enabled = true;
    }

    resetEditid() {
        this.editid = 0;
    }

    /* MULTIPLE CHECKBOX ACTION METHOD */
    selection = new SelectionModel<string>(true, []);
    isAllSelected() {
        if (!this.dataSource) { return false; }
        if (this.selection.isEmpty()) { return false; }

        let d = this.dataSource.data.filter(x => {
            return (x['menuStatus'] == 2);
        })
        return this.selection.selected.length == d.length;
    }
    masterToggle() {
        if (!this.dataSource) { return; }

        if (this.isAllSelected()) {
            this.selection.clear();
        } else {
            let d = this.dataSource.data.filter(x => {
                return (x['menuStatus'] == 2);
            })
            d.forEach(data => { this.selection.select(data['menuPk']) });
        }
    }

    /* MULTIPLE ROW DELETE ACTION METHOD */
    multiplerowdel() {
        swal({
            title: "Are you sure want to delete?",
            icon: "warning",
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    const selectedpks = this.encrypt.encrypt(this.selection.selected.toString());

                    this.postParams = {
                        'menuPks':selectedpks
                    }
                    this.postUrl = 'mst/menumaster/multiple-delete';
                    this.enterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
                        function(data){
                        if(data['data'].status == 100){
                            swal({
                                text:'Deleted Successfully',
                                icon:'success'
                            }).then((value)=>{
                                if(value){
                                    this.selection.clear();
                                    this.commonPaginatorSearch();
                                }
                            });
                        }
                        }.bind(this)
                    );

                }
            });
    }
    /* FILTER FORM RESET METHOD */
    formreset() {
        this.moduleName = '';
        this.subModuleName = '';
        this.stkholderType = '';
        this.menuName = '';
        this.status = '';
        this.type = '';

        this.paginator.pageSize = this.perpage = 10;
        this.paginator.pageIndex = 0;

        this.postParams = {
            'size':this.perpage,
            'page':this.paginator.pageIndex,
        };
        this.menuListData(this.postParams);
    }
    
    menuEdit(menuPk){
        this.createMenu.menuEditData(menuPk);
    }

    deleteMenu(menuPk) {
        var msg = "Are you sure want to delete?";
        swal({
            title: msg,
            icon: "warning",
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                this.changeMenuStatus(menuPk,3);
            }
        });
    }

    changestatus(menuPk, status){
        let msg = '';
        if(status == 1){
            msg = "Are you sure want to Deactivate?";
            status = 2;
        }else{
            msg = "Are you sure want to Activate?";
            status = 1;
        }
        swal({
            title: msg,
            icon: "warning",
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                this.changeMenuStatus(menuPk,status);
            }
        });
    }

    changeMenuStatus(menuPk, status){
        let statMsg = '';
        if(status == 3){
            statMsg = 'Deleted Successfully';
        }else if(status == 2){
            statMsg = 'Deactivated Successfully';
        }else if(status == 1){
            statMsg = 'Activated Successfully';
        }

        this.postParams = {
            'menuPk':this.encrypt.encrypt(menuPk),
            'status':status
        };
        this.postUrl = 'mst/menumaster/change-menu-status';
        this.enterpriseService.enterpriseService(this.postParams,this.postUrl).subscribe(
            function(data){
                if(data['data'].status == 100){
                    swal({
                        text:statMsg,
                        icon:'success',
                    });
                    this.commonPaginatorSearch();
                }else{
                    swal({
                        text:data['data'].msg,
                        icon:'warning',
                    });
                }
            }.bind(this)
        );
    }

    onPaginateChange(event) {
        this.perpage = event.pageSize;
        this.commonPaginatorSearch();
    }

    commonPaginatorSearch(){
        this.postParams = {
            'size': this.perpage,
            'page': this.paginator.pageIndex,
            'stkholderType':this.filterform.controls['stkholderType'].value,
            'menuName':this.filterform.controls['menuName'].value,
            'moduleName':this.filterform.controls['moduleName'].value,
            'status':this.filterform.controls['status'].value,
            'menuType':this.filterform.controls['menuType'].value
            //'menuTypes':this.menuTypes.value
        };
        this.menuListData(this.postParams);
    }

    sweetalert(data)
    {
        swal({
        text:data.msg,
        icon:data.statusmsg,
        }).then((value)=>{
            if(data.flag =="S")
            {
            
            }
            else {
            }
        });
    }

    menuAddData(event){
        if(event == 1){
            this.paginator.pageSize = this.perpage;
            this.paginator.pageIndex = 0;
            this.postParams = {
                'size':this.perpage,
                'page':this.paginator.pageIndex,
            };
            this.menuListData(this.postParams);
        }else{
            this.commonPaginatorSearch();
        }
    }

    sortEvent(event){
        this.postParams = {
            'size':this.perpage,
            'page':this.paginator.pageIndex,
            'stkholderType':this.filterform.controls['stkholderType'].value,
            'menuName':this.filterform.controls['menuName'].value,
            'moduleName':this.filterform.controls['moduleName'].value,
            'status':this.filterform.controls['status'].value,
            'menuType':this.filterform.controls['menuType'].value,
            'column': this.sort.active,
            'direction': this.sort.direction
        };
        this.menuListData(this.postParams);
    }
}