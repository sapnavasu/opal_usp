import { Component, OnInit, ViewChild, AfterViewInit, Input,ChangeDetectorRef} from '@angular/core';
import { CountryService } from '../service/country.service';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { CustomValidators } from 'ng2-validation';
import { Observable } from 'rxjs';
import 'rxjs/add/observable/of';
import { Router, ActivatedRoute,Params  } from '@angular/router';
import {DataSource} from '@angular/cdk/collections';
import { Country } from "../models/country";
import {MatSort, MatSortable, MatTableDataSource,MatPaginator, MatDrawer} from '@angular/material';
import {MatIconModule} from '@angular/material/icon';
import {HttpClient} from '@angular/common/http';
import {merge} from 'rxjs/observable/merge';
import {of as observableOf} from 'rxjs/observable/of';
import {catchError} from 'rxjs/operators/catchError';
import {map} from 'rxjs/operators/map';
import {startWith} from 'rxjs/operators/startWith';
import {switchMap} from 'rxjs/operators/switchMap';
import { atLeastOne } from './../../../../config_files/directives/atleastone';
import { SelectionModel } from '@angular/cdk/collections';
import { GoogleAnalyticsService } from 'angular-ga';
import { environment } from '../../../../../../environments/environment';
let countrylist: Object;
@Component({
    selector: 'app-country',
    templateUrl: './country.component.html',
    styleUrls: ['./country.component.css']
})
export class CountryComponent implements AfterViewInit {
    public enabled;
    public editid:number=0;
  @ViewChild(MatDrawer) drawer: any;
    createbutton:boolean=true;
    updatebutton:boolean=false;
    searchfilter: boolean = false;
    pageEvent: any;
    resultsLength = 0;
    perpage=10;
    text:boolean=true;
    breadcrums=[
        {
            "url":"/mastermaintance/country","params":"","label":"manage country"
        }
    ];
    cid = null;
    constructor(private fb: FormBuilder,private countryservice: CountryService,
                protected router: Router,private http: HttpClient,
                private gaService: GoogleAnalyticsService,
                private changeDetector: ChangeDetectorRef) {}
    displayNoRecords:boolean;
    isRateLimitReached = false;
    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;
    displayedColumns = ['checkall','CyM_CountryName_en', 'CyM_CountryCode_en', 'CyM_CountryDialCode',
        'CyM_Status','actionsColumn'];
    exampleDatabase: ExampleHttpDao | null;
    dataSource = new MatTableDataSource();
    public showFilter='Show Filter';
    public name = '';
    public code = '';
    public dialcode = '';
    public querystr='';
    public status='';
    ngAfterViewInit() {
        // this.fetchData();
        // this.gaService.configure('UA-120075477-1');
        setTimeout(() => this.text = false,200);
        setTimeout(() => this.fetchData(),300);
    }
    searchiconclick() {
        this.searchfilter = !this.searchfilter;
        this.showFilter = this.searchfilter?'Hide Filter':'Show Filter';
    }
    /* FILTER FORM FIELD GROUP  */
    filterform = new FormGroup({
        countryname: new FormControl(''),
        countrycode: new FormControl(''),
        countrydialcode: new FormControl(''),
        countrystatus: new FormControl(''),
    }, { validators: atLeastOne(Validators.required) });

    /* FILTER FORM SUBMIT HANDLER */
    onFilterSubmit(){
        var formvalues = this.filterform.value;
        this.name = '';
        this.code = '';
        this.dialcode = '';
        this.status='';

        if(formvalues.countryname){
            this.name = formvalues.countryname.trim();
        }
        if(formvalues.countrycode){
            this.code = formvalues.countrycode.trim();
        }
        if(formvalues.countrydialcode){
            this.dialcode = formvalues.countrydialcode.trim();
        }
        if(formvalues.countrystatus){
            this.status = formvalues.countrystatus.trim();
        }
        var filterpagestring   =    '';
        var  perpage           =    10;
        const filtersign = (this.sort.direction == 'desc') ? '-' : '';
        filterpagestring = `sort=${filtersign}${this.sort.active}&order=${this.sort.direction}&page=${this.paginator.pageIndex + 1}&size=${this.perpage}`;
        this.countryservice.countrytablefilter(filterpagestring,this.name, this.code, this.dialcode,this.status).subscribe(countrydata => {
            this.gaService.event.emit({
                category: 'superadmin/mm',
                action: 'Search Country'
            });
            this.dataSource.data = countrydata['data'].items;
            this.resultsLength = countrydata['data'].total_count;
        })
    }
    reloadTree(){
        
        this.enabled = false;
        this.changeDetector.detectChanges();
        this.enabled = true; 
      }
      resetEditid(){
        this.editid=0;
      }
    /* MULTIPLE CHECKBOX METHOD */
    selection = new SelectionModel<string>(true, []);
    isAllSelected() {
        if (!this.dataSource) { return false; }
        if (this.selection.isEmpty()) { return false; }
        return this.selection.selected.length == this.dataSource.data.length;
    }
    masterToggle() {
        if (!this.dataSource) { return; }

        if (this.isAllSelected()) {
            this.selection.clear();
        } else {
            this.dataSource.data.forEach(data => { this.selection.select(data['CountryMst_Pk'])})
        }
    }
    /* DATA TABLE FETCH DATA */
    fetchData(){
        this.exampleDatabase = new ExampleHttpDao(this.http);
        // If the user changes the sort order, reset back to the first page.
        this.sort.sortChange.subscribe(() => this.paginator.pageIndex = 0);
        merge(this.sort.sortChange, this.paginator.page)
            .pipe(
                startWith({}),
                switchMap(() => {
                    this.querystr='';
                    if(this.name && this.name !=null) {
                        this.querystr +=`&CyM_CountryName_en=${this.name}`;
                    }
                    if(this.code && this.code !=null) {
                        this.querystr +=`&CyM_CountryCode_en=${this.code}`;
                    }
                    if(this.dialcode && this.dialcode !=null) {
                        this.querystr +=`&CyM_CountryDialCode=${this.dialcode}`;
                    }
                    if(this.status && this.status !=null) {
                        this.querystr +=`&CyM_Status=${this.status}`;
                    }
                    this.querystr+=`&type=${'filter'}`;
                    return this.exampleDatabase!.statedatas(
                        this.sort.active, this.sort.direction, this.paginator.pageIndex,this.perpage,this.querystr);
                }),
                map(data => {
                    // Flip flag to show that loading has finished.
                    this.isRateLimitReached = false;
                    this.resultsLength =data['data'].total_count;
                    return data['data'].items;
                }),
                catchError(() => {
                    //this.isLoadingResults = false;
                    // Catch if the GitHub API has reached its rate limit. Return empty data.
                    this.isRateLimitReached = true;
                    return observableOf([]);
                })
            ).subscribe(data => this.dataSource.data = data);
    }
    /* MULTIPLE DATA DELETED */
    multiplerowdel(){
        var del_ids = this.selection.selected.length;
        swal({
            title: "Are you sure want to delete?",
            icon: "warning",
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    this.selection.selected.forEach(dataids => {
                        this.countryservice.deletecountry(dataids).subscribe(datares => {
                            if(datares){
                                swal('Success!',"Deleted Successfully", {
                                    icon: "success",
                                });
                                this.fetchData();
                                this.selection.clear();
                            }

                        });
                    })
                }
            });
    }
    /* DATA TABLE RESET DATA */
    formreset(){
        this.name = '';
        this.code = '';
        this.dialcode = '';
        this.status='';
        this.fetchData();
    }
    startEdit(cid:number)
    {   this.reloadTree();
        // this.router.navigate(['/mastermaintance/newcountry/createcountry/',cid]);
        this.editid=cid;
        this.drawer.toggle();
    }
    cancelOrDelete(row) {
        var msg="Are you sure want to delete?";
        var flash="Deleted Successfully";
        swal({
            title:msg,
            icon: "warning",
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                this.countryservice.deletecountry(row).subscribe( data => {
                    if(data)
                    {
                        swal('Success!',flash, {
                            icon: "success",
                        });
                        this.ngAfterViewInit() ;
                    }

                });
            }
        });
}

    onPaginateChange(event)
    {
        this.perpage=event.pageSize;
    }
    changestatus(id,currentstatus)
    {
        var msg=(currentstatus=="I")?"Are you sure want to Activate?":"Are you sure want to Deactivate?";
        var flash=(currentstatus=="A")?"Deactivated Successfully":"Activated Successfully";
        swal({
            title:msg,
            icon: "warning",
            buttons: ['Cancel', 'Ok'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    this.countryservice.updatestatus(id).subscribe( data => {
                        if(data)
                        {
                            swal(flash, {
                                icon: "success",
                            });
                            this.ngAfterViewInit() ;
                        }

                    });
                }
            });
    }
}
export interface GithubApi {
    items: Country[];
    total_count: number;
}
/** An example database that the data source uses to retrieve data for the table. */
export class ExampleHttpDao {
    constructor(private http: HttpClient) {}
    statedatas(sort: string, order: string, page: number,size:number,query:string): Observable<GithubApi> {
        const href = environment.baseUrl+'mst/country/index';
        const sign=(order =='desc')?'-':'';
        const requestUrl =
            `${href}?sort=${sign}${sort}&order=${order}&page=${page + 1}&size=${size}${query}`;
        return this.http.get<GithubApi>(requestUrl);
    }
}
