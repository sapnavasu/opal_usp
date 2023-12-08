import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-configurecentredashboard',
  templateUrl: './configurecentredashboard.component.html',
  styleUrls: ['./configurecentredashboard.component.scss']
})
export class ConfigurecentredashboardComponent implements OnInit {

  data=[
    {
      img : 'opal-Approval-Management',
      title: 'International Recognition & Accreditation',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Document Required',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
  ]
  
  constructor(private router: Router,) { }

  ngOnInit(): void {
  }

  action(url){
    this.router.navigate([url]);
  }
}
