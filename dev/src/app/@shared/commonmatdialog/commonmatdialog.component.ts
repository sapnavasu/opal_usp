import { Component, OnInit } from "@angular/core";

export interface Eachbox {
  title: string;
  feature1: string;
  feature2: string;
  feature3: string;
  buttontext:string;
}
@Component({
  selector: "app-commonmatdialog",
  templateUrl: "./commonmatdialog.component.html",
  styleUrls: ["./commonmatdialog.component.scss"],
})
export class CommonmatdialogComponent implements OnInit {
  eachboxlist: Eachbox[] = [
    {
      title: "Quick",
      feature1: "Easy to create",
      feature2: "Minimal Fields",
      feature3: "",
      buttontext:'Create'
    },
    {
      title: "Advanced",
      feature1: "Indepth Product/Service",
      feature2: "Delivery Notification",
      feature3: "Invoice Module",
      buttontext:'Subscribe'
    },
  ];
  constructor() {}

  ngOnInit() {}
}
