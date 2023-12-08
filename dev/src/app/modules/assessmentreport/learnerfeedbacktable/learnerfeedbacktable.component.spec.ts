import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LearnerfeedbacktableComponent } from './learnerfeedbacktable.component';

describe('LearnerfeedbacktableComponent', () => {
  let component: LearnerfeedbacktableComponent;
  let fixture: ComponentFixture<LearnerfeedbacktableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LearnerfeedbacktableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LearnerfeedbacktableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
