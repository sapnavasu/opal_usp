import { Component, OnInit,ViewEncapsulation, Input, HostListener,Output, EventEmitter,ViewChild, ElementRef, AfterViewInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormArray, AbstractControl } from '@angular/forms';
import * as ClassicEditorBuild from '@ckeditor/ckeditor5-build-classic';
import { MatDrawer } from '@angular/material/sidenav';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Encrypt } from '@app/common/class/encrypt';
import { InptLang_Ctrl } from '@env/InptLang_Ctrl';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { SelectionModel } from '@angular/cdk/collections';
import { MatSidenav } from '@angular/material/sidenav';

export interface contractdetailslst {
  suppliercode: string;
  organizationname: string;
  contract: string;
  contractfeeusd: string;
  tendertype: string;
  invoicedate: string;
  invoiceage: string;
  submittedon: string;
  paymentsts: string;
  action: string;
 
}
const ELEMENT_DATA: contractdetailslst[] = [
    {
        suppliercode: "OMN100534",
        organizationname: "Business Gateways International - India ",
        contract: "Contract Related To Nizwa Industrial City Expansion...",
        contractfeeusd: "150.000",
        tendertype: "Online Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Payment Pending",
        action:"",
    },
    {
        suppliercode: "OMN100662",
        organizationname: "Mohammed Bin Abdullah INC.",
        contract: "Maintenance And Installation Of Beam Pump Units..",
        contractfeeusd: "125.000",
        tendertype: "Online Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Verification Pending",
        action:"",
    },
    {
        suppliercode: "OMN100466",
        organizationname: "Adnoc Trading Company Pvt. Ltd.",
        contract: "Extension Of Electrical Distribution Network",
        contractfeeusd: "50.000",
        tendertype: "Online Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Approved",
        action:"",
    },
    {
        suppliercode: "OMN103543",
        organizationname: "Ahmed Electric company Pvt. Ltd.",
        contract: "Contracts For Two New Flood Protection Dams...",
        contractfeeusd: "75.000",
        tendertype: "Online Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Approved",
        action:"",
    },
    {
        suppliercode: "OMN000167",
        organizationname: "Business Gateways International - Oman",
        contract: "Provide Critical Backup For Adnoc Onshore's...",
        contractfeeusd: "180.000",
        tendertype: "Offline Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Approved",
        action:"",
    },
    {
        suppliercode: "OMN100027",
        organizationname: "The Libyan Company for Foreign Trade",
        contract: "Major Cryogenic Gas Transport Contract.",
        contractfeeusd: "225.000",
        tendertype: "Online Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Payment In Progress",
        action:"",
    },
    {
        suppliercode: "OMN109732",
        organizationname: "Petroleum Investment Company Pvt. Ltd.",
        contract: "Six Fuel Tankers And 11 Scania Trucks Enhance...",
        contractfeeusd: "50.000",
        tendertype: "Offline Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Declined",
        action:"",
    },
    {
        suppliercode: "OMN100345",
        organizationname: "Ram Govind Traders",
        contract: "Optimise Onshore Field Operations And Enhancements",
        contractfeeusd: "50.000",
        tendertype: "Online Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Approved",
        action:"",
    },
    {
        suppliercode: "OMN287333",
        organizationname: "The Libyan Company for Foreign Trade",
        contract: "Major Cryogenic Gas Transport Contract.",
        contractfeeusd: "225.000",
        tendertype: "Online Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Payment In Progress",
        action:"",
    },
    {
        suppliercode: "OMN287234",
        organizationname: "Petroleum Investment Company Pvt. Ltd.",
        contract: "Six Fuel Tankers And 11 Scania Trucks Enhance...",
        contractfeeusd: "50.000",
        tendertype: "Online Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Declined",
        action:"",
    },
    {
        suppliercode: "OMN287236",
        organizationname: "Ram Govind Traders",
        contract: "Optimise Onshore Field Operations And Enhancements",
        contractfeeusd: "50.000",
        tendertype: "Online Tendering",
        invoicedate: "15-05-2021",
        invoiceage: "35 Days ",
        submittedon: "15-05-2021",
        paymentsts: "Approved",
        action:"",
    },
    
]
@Component({
  selector: 'app-contractsuccessfeeapproval',
  templateUrl: './contractsuccessfeeapproval.component.html',
  styleUrls: ['./contractsuccessfeeapproval.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContractsuccessfeeapprovalComponent implements OnInit {

    displayedColumns: string[] = [
        "suppliercode", "organizationname", "contract", "contractfeeusd", "tendertype", "invoicedate","invoiceage","submittedon","paymentsts","action"
    ];
    datasource = new MatTableDataSource<contractdetailslst>(ELEMENT_DATA);

    public contracopt:any = [];
    public contractName;
    public contsearchSec;
    
    rfifilter;
    pageEvent: PageEvent;
    resultsLength: number = 10;
    @ViewChild(MatSort) sort: MatSort;
    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild('contractfeepanel') public contractfeeapp: MatSidenav;
    @ViewChild('paymentstatus') public onlinepaymentsts: MatSidenav;
    

    constructor(private http: HttpClient,private router:Router, private security:Encrypt, ) { }
    ngOnInit() {
        

        this.contracopt = [
            { UserMst_Pk:1, name:'Payment Pending' },
            { UserMst_Pk:2, name:'Verification Pending' },
            { UserMst_Pk:3, name:'Payment In Progress' }, 
            { UserMst_Pk:4, name:'Approved' },
            { UserMst_Pk:5, name:'Declined' },
            { UserMst_Pk:6, name:'PDO LCC Category' },
        ]
    }

    syncPrimaryPaginator(event: PageEvent) {
        this.paginator.pageIndex = event.pageIndex;
        this.paginator.pageSize = event.pageSize;
        this.paginator.page.emit(event);

    }

    applyFilter(filterValue: string) {
        this.datasource.filter = filterValue.trim().toLowerCase();
        if (this.datasource.paginator) {
        this.datasource.paginator.firstPage();
        }
    }

    selection = new SelectionModel<contractdetailslst>(true, []);
    isAllSelected() {
        const numSelected = this.selection.selected.length;
        const numRows = this.datasource.data.length;
        return numSelected === numRows;
    }

    masterToggle() {
        this.isAllSelected() ?
            this.selection.clear() :
            this.datasource.data.forEach(row => this.selection.select(row));
    }

    
    getuserpk(value) {
        for(var i=0;i<this.contracopt.length;i++) {
            if(this.contracopt[i]['UserMst_Pk']==value){
                this.contractName = this.contracopt[i]['name'];
            }
        }
    }
    openedChange(boolean){
        this.contsearchSec = "";
    }

    clearSearchField() {
        this.rfifilter = '';
    }

    ngAfterViewInit (){
        this.datasource.paginator = this.paginator;
        this.datasource.sort = this.sort;
      }
    
}
