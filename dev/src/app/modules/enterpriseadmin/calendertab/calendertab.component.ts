import { Component, OnInit } from "@angular/core";
import { MatCalendarCellCssClasses } from "@angular/material/datepicker";

export interface Eacheventlist {
  eventname: string;
  eventtime: string;
}
@Component({
  selector: "app-calendertab",
  templateUrl: "./calendertab.component.html",
  styleUrls: ["./calendertab.component.scss"],
})
export class CalendertabComponent implements OnInit {
  eventlists: Eacheventlist[] = [
    {
      eventname: "Australasian Oil & Gas Exhibition & Conference",
      eventtime:
        "11:00 AM  to  12:30 PM",
    },
    {
      eventname: "The Canadian Oil & Gas Industry Conference",
      eventtime:
        "11:00 AM  to  12:30 PM",
    },
    {
      eventname: "Nigeria Oil & Gas Conference & Exhibition",
      eventtime:
        "11:00 AM  to  12:30 PM",
    },
    {
      eventname: "The Canadian Oil & Gas Industry Conference",
      eventtime:
        "11:00 AM  to  12:30 PM",
    },
    {
      eventname: "Australasian Oil & Gas Exhibition & Conference",
      eventtime:
        "11:00 AM  to  12:30 PM",
    },
    {
      eventname: "Nigeria Oil & Gas Conference & Exhibition",
      eventtime:
        "11:00 AM  to  12:30 PM",
    },
  ];
  selectedDate: any;

  datesToHighlight = [
    "2019-01-22T18:30:00.000Z",
    "2019-01-22T18:30:00.000Z",
    "2019-01-24T18:30:00.000Z",
    "2019-01-28T18:30:00.000Z",
    "2019-01-24T18:30:00.000Z",
    "2019-01-23T18:30:00.000Z",
    "2019-01-22T18:30:00.000Z",
    "2019-01-25T18:30:00.000Z",
  ];
  constructor() {}

  ngOnInit() {}
  onSelect(event) {
    this.selectedDate = event;
  }

  dateClass() {
    return (date: Date): MatCalendarCellCssClasses => {
      const highlightDate = this.datesToHighlight
        .map((strDate) => new Date(strDate))
        .some(
          (d) =>
            d.getDate() === date.getDate() &&
            d.getMonth() === date.getMonth() &&
            d.getFullYear() === date.getFullYear()
        );

      return highlightDate ? "special-date" : "";
    };
  }
  public scrollTo(className: string): void {
    try {
        const elementList = document.querySelectorAll('.' + className);
        const element = elementList[0] as HTMLElement;
        element.scrollIntoView({ behavior: 'smooth'});
    } catch (error) {
        console.log('page-content')
        }
    }
}
