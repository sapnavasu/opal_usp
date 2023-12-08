import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LearnerRegisterComponent } from './learner-register.component';

describe('LearnerRegisterComponent', () => {
  let component: LearnerRegisterComponent;
  let fixture: ComponentFixture<LearnerRegisterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LearnerRegisterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LearnerRegisterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

