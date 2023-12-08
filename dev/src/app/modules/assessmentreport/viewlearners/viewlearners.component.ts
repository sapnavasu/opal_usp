import {OnInit, Component, ViewChild, AfterViewInit, ViewEncapsulation} from '@angular/core';
import {MatPaginator, PageEvent} from '@angular/material/paginator';
import {MatTableDataSource} from '@angular/material/table';
import {MatSort} from '@angular/material/sort';
import {SelectionModel} from '@angular/cdk/collections';
import { TranslateService } from '@ngx-translate/core';
import { AssessmentReportService } from '@app/services/assessmentReport.service';
import { ActivatedRoute } from '@angular/router';


export interface PeriodicElement {
  civilNumber: number;
  learnerName: string;
  emailID: string;
  age: number;
  gender: string;
  status: string;
  knowledgeAssessment: string;
  practicalAssessment: string;
  
}

const ELEMENT_DATA: PeriodicElement[] = [
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Completed', knowledgeAssessment : 'Pass' , practicalAssessment :'Pass' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Completed', knowledgeAssessment : 'Fail' , practicalAssessment :'Pass' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Completed', knowledgeAssessment : 'Pass' , practicalAssessment :'Fail' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Competent' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Non-Competent' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Retake Assessment', knowledgeAssessment : 'Fail' , practicalAssessment :'Fail' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
  {civilNumber: 10610795, learnerName: 'Muhammad', emailID: 'muhammed@gmail.com', age: 38, gender : 'Male' , status : 'Assessment', knowledgeAssessment : 'Pending' , practicalAssessment :'Pending' },
];

@Component({
  selector: 'app-viewlearners',
  templateUrl: './viewlearners.component.html',
  styleUrls: ['./viewlearners.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ViewlearnersComponent implements AfterViewInit, OnInit {
  i18n(key){
    return this.translate.instant(key);
  }
  displayedColumns: string[] = ['select','civilNumber', 'learnerName', 'emailID', 'age', 'gender','status', 'knowledgeAssessment', 'practicalAssessment', 'Action'];
  dataSource = new MatTableDataSource<PeriodicElement>(ELEMENT_DATA);
  selection = new SelectionModel<PeriodicElement>(true, []);
  actionOption: string[] = ['Update Assessment Report', 'Retake Assessment', 'View Card','Print Card','View & Approve']
  page: number = 5;
  showfilter= false;
  hidefilder: boolean = true;
  filtername = "Hide Filter";
  batchdata_data;
  leanerdata_data;
  id: string;
  resultsLength =0;
  constructor(private translate: TranslateService, private assessmentService: AssessmentReportService, private route: ActivatedRoute) {}

  @ViewChild("paginator") paginator: MatPaginator;
  @ViewChild(MatSort) sort: MatSort;

  ngOnInit(){//'6540025'
    this.id = this.route.snapshot.paramMap.get('id');
    this.getbatchdtls(this.id);
    this.getleanersdtls(this.id);
  }
  ngAfterViewInit() {

    this.dataSource.paginator = this.paginator;
    this.dataSource.sort = this.sort;
  }  

  getbatchdtls(id)
  {
    this.assessmentService.getbatchdtls(id).subscribe(data=>{
      this.batchdata_data = data.data.data;
      console.log(this.batchdata_data)
    });
  }

  getleanersdtls(id)
  {
    this.assessmentService.getleanersdtls(id).subscribe(data=>{
      this.leanerdata_data = data.data.data;
      console.log(this.leanerdata_data)
    });
  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = this.i18n('course.showfilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = this.i18n('course.hidefilt');
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }
  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.page = event.pageSize;
  }

  filter(){
    this.showfilter = !this.showfilter;
  }
  /** Whether the number of selected elements matches the total number of rows. */
  isAllSelected() {
    const numSelected = this.selection.selected.length;
    const numRows = this.dataSource.data.length;
    return numSelected === numRows;
  }

  /** Selects all rows if they are not all selected; otherwise clear selection. */
  toggleAllRows() {
    if (this.isAllSelected()) {
      this.selection.clear();
      return;
    }

    this.selection.select(...this.dataSource.data);
  }

  /** The label for the checkbox on the passed row */
  checkboxLabel(row?: PeriodicElement): string {
    if (!row) {
      return `${this.isAllSelected() ? 'deselect' : 'select'} all`;
    }
    return `${this.selection.isSelected(row) ? 'deselect' : 'select'} row ${row.civilNumber + 1}`;
  }

  getassessmentstatus(no){
    //1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 5-Requested for Back Track, 6-Quality Check, 7-Cancelled, 8-Print,9-Requested for Assessor change
    if(no == 1){
      return 'New'
    } else if(no == 2){
      return 'Teaching(theory)'
    }
    else if(no == 3){
      return 'Teaching(practical)'
    }
    else if(no == 4){
      return 'Assessment'
    }
    else if(no == 5){
      return 'Requested for Back Track'
    }
    else if(no == 6){
      return 'Quality Check'
    }
    else if(no == 7){
      return 'Cancelled'
    }
    else if(no == 8){
      return 'Print'
    }
    else if(no == 9){
      return 'Requested for Assessor change'
    }
    else{
      return ''
    }
  }

 
}
