import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AssessmentreportComponent } from './assessmentreport.component';

describe('AssessmentreportComponent', () => {
  let component: AssessmentreportComponent;
  let fixture: ComponentFixture<AssessmentreportComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AssessmentreportComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AssessmentreportComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
