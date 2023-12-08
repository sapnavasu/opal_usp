import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewassessmentComponent } from './viewassessment.component';

describe('ViewassessmentComponent', () => {
  let component: ViewassessmentComponent;
  let fixture: ComponentFixture<ViewassessmentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewassessmentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewassessmentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
