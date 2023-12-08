import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  data=[
    {
      img : 'opal-Approval-Management',
      title: 'Maintenance Configuration',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Configure Third Party Integration',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Master Data Configuration',
      url:'/configuration/master_data_dashaboard',
      content: 'This module facilitates the configuration of a drop-down list, which includes Fee Subscription, Course Categories, Course Sub-Categories, MOHERI Grading, Education Level, Course Level, Request For, Assessment in, Road Type, Technical Evaluation Project - Categories.'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Approval Workflow Configuration',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Grade Configuration',
      url:'',
      content: 'This module facilitates the configuration of Percentage from Total Value, From Percentage and To Percentage for the Grade. These configured Grade enable when the Training Centre seeks Centre Certification and undergo the Site Audits, the configured Grades enable the calculation for each grade and total score percentage.'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Standard Course Configuration',
      url:'',
      content: 'This module facilitates the configuration of standard courses, sub-categories, and associated details. These configured courses enable Training Centre’s to apply for certification, and upon approval, Centre can effectively organize batches for the certified courses.'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Customized Course Configuration',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Configure Centre Application Form',
      url:'/configuration/configure_centre_dashboard',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Checklist Configuration',
      url:'/configuration/checklist_dashboard',
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
