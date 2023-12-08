import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';


@Component({
  selector: 'app-checklistconfigdashboard',
  templateUrl: './checklistconfigdashboard.component.html',
  styleUrls: ['./checklistconfigdashboard.component.scss']
})
export class ChecklistconfigdashboardComponent implements OnInit {

  data=[
    {
      img : 'opal-Approval-Management',
      title: 'Certification Siter Audit Checklist',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Learner Assessment',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Learner Feeback',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Opal Star Staff Assessment',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Technical Centre (Inspection/Installation) Checklist',
      url:'',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Technical Centre Staff Assessment',
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
