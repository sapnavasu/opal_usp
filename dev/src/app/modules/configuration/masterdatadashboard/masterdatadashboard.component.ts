import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-masterdatadashboard',
  templateUrl: './masterdatadashboard.component.html',
  styleUrls: ['./masterdatadashboard.component.scss']
})
export class MasterdatadashboardComponent implements OnInit {

  data=[
    {
      img : 'opal-Approval-Management',
      title: 'Fee Subscription',
      url:'/configuration/masterdataconfiguration/feesubscribtion',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Course Categories',
      url:'/configuration/masterdataconfiguration/coursecategory',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Course Sub-Categories',
      url:'/configuration/masterdataconfiguration/coursesubcategory',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'MOHERI Grading',
      url:'/configuration/masterdataconfiguration/moherigrading',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Education Level',
      url:'/configuration/masterdataconfiguration/educationlevel',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Course Level',
      url:'/configuration/masterdataconfiguration/courselevel',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Request For',
      url:'/configuration/masterdataconfiguration/requestfor',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Assessment in',
      url:'/configuration/masterdataconfiguration/assessmentin',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Road Type',
      url:'/configuration/masterdataconfiguration/roadtype',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Vechicle Categories',
      url:'/configuration/masterdataconfiguration/vehiclecategories',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Vechicle Sub-Categories',
      url:'/configuration/masterdataconfiguration/vehiclesubcategories',
      content: 'Angular Flex-Layout is a stand-alone library developed by the Angular team for designing sophisticated layouts. When creating an HTML page in Angular, using Angular Flex-Layout allows us to easily create FlexBox-based page layouts with a set of directives available for use in your templates'
    },
    {
      img : 'opal-Approval-Management',
      title: 'Vechicle Manufacturers',
      url:'/configuration/masterdataconfiguration/vehiclemanufacturers',
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
