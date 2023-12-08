import { Component, OnInit, Input, ViewChild } from '@angular/core';
import swal from 'sweetalert';
import { SlideInOutAnimation } from '@app/common/drive/animation';
import { MatDrawer } from '@angular/material/sidenav';
import { MatTableDataSource } from '@angular/material/table';

export interface Element {
  reassignto: string;
  reassignby: string;
  reassigntype: string;
  reassignbyon: string;
  fromdate: string;
  Todate: string;
}

const ELEMENT_DATA: Element[] = [
  {
    reassignto: "Muzaffar",
    reassignby: "Administrator",
    reassigntype: "Permanent",
    reassignbyon: "30-10-2020  10:00",
    fromdate: "-",
    Todate: "-",
  },
  {
    reassignto: "Ahmed Al Badi Syed Khan",
    reassignby: "Administrator",
    reassigntype: "Temporary",
    reassignbyon: "20-08-2020  10:10",
    fromdate: "21-08-2020  10:00",
    Todate: "30-08-2020  23:59",
  },
  {
    reassignto: "Khalsa Al Aghbari",
    reassignby: "Administrator",
    reassigntype: "Temporary",
    reassignbyon: "30-09-2020  22:00",
    fromdate: "30-05-2020  09:00",
    Todate: "04-06-2020  23:59",
  },
  {
    reassignto: "Mohammed Monsour",
    reassignby: "Administrator",
    reassigntype: "Temporary",
    reassignbyon: "28-08-2020  13:00",
    fromdate: "28-02-2020  08:00",
    Todate: "05-01-2020  23:59",
  }
];

@Component({
  selector: 'app-reassign-history',
  templateUrl: './reassign-history.component.html',
  styleUrls: ['./reassign-history.component.scss'],
  animations: [SlideInOutAnimation],
})
export class ReassignHistoryComponent implements OnInit {
  animationState3 = 'out';
  @Input('reassignhistorydrawer') reassignhistorydrawer: MatDrawer;
  dataSource = new MatTableDataSource<Element>(ELEMENT_DATA);
  displayedColumns = ['reassign_to', 'reassign_by','re-assignedtype', 'reassign_on','from_date','To_date',
   ];
  constructor() { }

  ngOnInit() {
  }

  reassignhistoryalert() {
    this.reassignhistorydrawer.toggle();
    this.animationState3 = 'out';
  }
  reassignhistorylistdropdown(divName: string) {
    if (divName === 'reassignhistorylistview') {
      this.animationState3 = this.animationState3 === 'out' ? 'in' : 'out';
    }
  }

}
