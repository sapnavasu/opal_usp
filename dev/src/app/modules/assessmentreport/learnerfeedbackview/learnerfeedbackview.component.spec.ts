import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LearnerfeedbackviewComponent } from './learnerfeedbackview.component';

describe('LearnerfeedbackviewComponent', () => {
  let component: LearnerfeedbackviewComponent;
  let fixture: ComponentFixture<LearnerfeedbackviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LearnerfeedbackviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LearnerfeedbackviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
