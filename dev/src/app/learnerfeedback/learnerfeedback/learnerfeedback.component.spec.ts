import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LearnerfeedbackComponent } from './learnerfeedback.component';

describe('LearnerfeedbackComponent', () => {
  let component: LearnerfeedbackComponent;
  let fixture: ComponentFixture<LearnerfeedbackComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LearnerfeedbackComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LearnerfeedbackComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
