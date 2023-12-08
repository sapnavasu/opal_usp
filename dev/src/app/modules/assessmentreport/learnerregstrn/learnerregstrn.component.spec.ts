import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LearnerregstrnComponent } from './learnerregstrn.component';

describe('LearnerregstrnComponent', () => {
  let component: LearnerregstrnComponent;
  let fixture: ComponentFixture<LearnerregstrnComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LearnerregstrnComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LearnerregstrnComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
