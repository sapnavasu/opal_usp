import { Component, OnInit, ViewEncapsulation, ViewChild} from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { MomentDateAdapter } from '@angular/material-moment-adapter';
import { DateAdapter, ErrorStateMatcher, MAT_DATE_FORMATS, MAT_DATE_LOCALE } from '@angular/material/core';
import {MatTableDataSource} from '@angular/material/table';
import {MatPaginator, PageEvent} from '@angular/material/paginator';

export const MY_FORMATS = {
  parse: {
    dateInput: 'DD-MM-YYYY',
  },
  display: {
    dateInput: 'DD-MM-YYYY',
    monthYearLabel: 'MMM YYYY',
    dateA11yLabel: 'LL',
    monthYearA11yLabel: 'MMMM YYYY',
  },
};

export interface Learnerreg {
  sno:string;
  civilno: string;
  learnername: string;
  email: string;
  age: string;
  gender: string;
  theorytutor: string;
  practltutor: string;
  assessor: string;
  ivqastaff: string;
  feestatus: string;
  status: string;
  knowledgeassessmnt: string;
  practicalassessmnt: string;
  action: string;
}

const LEARNERREG_DATA: Learnerreg[] = [
  {sno:'1', civilno: '10610795', learnername: 'Mohammed Hussain', email: 'muhammed@gmail.com', age: '35', gender: 'Male', theorytutor: 'Taj Ahmed Safar', practltutor: 'Ahmed Safar', assessor: 'Fareeqh Fahad', ivqastaff: 'Zahi Kateeb Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Pending', practicalassessmnt: 'Pending', action:''},
  {sno:'1', civilno: '10610695', learnername: 'Mohammed Farq', email: 'farq@gmail.com', age: '40', gender: 'Male', theorytutor: 'Syed Ahmed Safar', practltutor: 'Syed Safar', assessor: 'Sayaf Ali', ivqastaff: 'Zahi Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Pass', practicalassessmnt: 'Fail', action:''},
  {sno:'1', civilno: '10610795', learnername: 'Ahmed Hussain', email: 'ahmed@gmail.com', age: '36', gender: 'Male', theorytutor: 'Ahmed Safar', practltutor: 'Safar Akbar', assessor: 'Fareeqh Fahad', ivqastaff: 'Asiyah Kateeb', feestatus: 'Yet to Pay', status: 'New', knowledgeassessmnt: 'Pass', practicalassessmnt: 'Pass', action:''},
  {sno:'1', civilno: '10610765', learnername: 'Aktar Hussain', email: 'aktar@gmail.com', age: '35', gender: 'Male', theorytutor: 'Aktar Safar', practltutor: 'Taj Ahmed Safar', assessor: 'Syed Khan', ivqastaff: 'Zahi Kateeb Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Fail', practicalassessmnt: 'Pass', action:''},
  {sno:'1', civilno: '10610775', learnername: 'Safar Ali', email: 'safar@gmail.com', age: '39', gender: 'Male', theorytutor: 'Safar Akbar', practltutor: 'Noor Safarh', assessor: 'Fareeqh Fahad', ivqastaff: 'Kateeb Asiyah', feestatus: 'Yet to Pay', status: 'New', knowledgeassessmnt: 'Pass', practicalassessmnt: 'Pass', action:''},
  {sno:'1', civilno: '10610795', learnername: 'Mohammed Taj', email: 'taj@gmail.com', age: '45', gender: 'Male', theorytutor: 'Taj Ahmed Safar', practltutor: 'Aktar Safar', assessor: 'Ibrahm Syed', ivqastaff: 'Ali Asiyah', feestatus: 'Yet to Pay', status: 'New', knowledgeassessmnt: 'Pass', practicalassessmnt: 'Fail', action:''},
  {sno:'1', civilno: '10610794', learnername: 'Mohammed Noor', email: 'noor@gmail.com', age: '46', gender: 'Male', theorytutor: 'Noor Safar', practltutor: 'Syed Faris Atiyeh', assessor: 'Fareeqh Fahad', ivqastaff: 'Aktar Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Fail', practicalassessmnt: 'Pending', action:''},
  {sno:'1', civilno: '10610791', learnername: 'Syed Hussain', email: 'syed@gmail.com', age: '34', gender: 'Male', theorytutor: 'Syed Safar', practltutor: 'Sajjad Faris Atiyeh', assessor: 'Fareeqh Fahad', ivqastaff: 'Akbar Asiyah', feestatus: 'Paid', status: 'New', knowledgeassessmnt: 'Pending', practicalassessmnt: 'Pass', action:''},
];


@Component({
  selector: 'app-learnerreglist',
  templateUrl: './learnerreglist.component.html',
  styleUrls: ['./learnerreglist.component.scss'],
  encapsulation: ViewEncapsulation.None,
  providers: [
    { provide: DateAdapter, useClass: MomentDateAdapter, deps: [MAT_DATE_LOCALE] },
    { provide: MAT_DATE_FORMATS, useValue: MY_FORMATS },
  ],
})
export class LearnerreglistComponent implements OnInit {


  filtername = "Hide Filter";
  hidefilder: boolean = true;
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  resultsLength = 0;
  PageEvent:any;


  /*civilnosrch: new FormControl('');
  learnernamesrch: new FormControl('');
  emailsrch: new FormControl('');
  agesrch: new FormControl('');
  gendersrch: new FormControl('');
  theorytutorsrch: new FormControl('');
  practltutorsrch: new FormControl('');
  assessorsrch: new FormControl('');
  ivqastaffsrch: new FormControl('');
  feestatussrch: new FormControl('');
  statussrch: new FormControl('');
  knowledgeassessmntsrch: new FormControl('');
  practicalassessmntsrch: new FormControl('');
  actionsrch: new FormControl('');

  filterValues = {
  civilnosrch: ' ',
  learnernamesrch: ' ',
  emailsrch: ' ',
  agesrch: ' ',
  gendersrch: ' ',
  theorytutorsrch: ' ',
  practltutorsrch: ' ',
  assessorsrch: ' ',
  ivqastaffsrch: ' ',
  feestatussrch: ' ',
  statussrch: ' ',
  knowledgeassessmntsrch: ' ',
  practicalassessmntsrch: ' ',
  actionsrch: ' '
  };*/

  displayedColumns = ['sno', 'civilno', 'learnername', 'email', 'age', 'gender', 'theorytutor', 'practltutor', 'assessor', 'ivqastaff', 'feestatus', 'status', 'knowledgeassessmnt', 'practicalassessmnt','action'];
  learnerregdataSource = new MatTableDataSource<Learnerreg>(LEARNERREG_DATA);

  @ViewChild(MatPaginator) paginator: MatPaginator;

  constructor(private formBuilder: FormBuilder,) { }

  ngOnInit(): void {
  }
  ngAfterViewInit() {
    this.learnerregdataSource.paginator = this.paginator;
  }
  

  syncPrimaryPaginator(event: PageEvent) {
    this.paginator.pageIndex = event.pageIndex;
    this.paginator.pageSize = event.pageSize;
    this.paginator.page.emit(event);
  }
  clickEvent() {

    this.hidefilder = !this.hidefilder;
    if (!this.hidefilder) {
      this.filtername = "Show Filter";
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'none';

    } else {
      this.filtername = "Hide Filter";
      const id = document.getElementById('searchrow') as HTMLElement;
      id.style.display = 'flex';

    }
  }

}
