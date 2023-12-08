import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LearnerreglistComponent } from './learnerreglist.component';

describe('LearnerreglistComponent', () => {
  let component: LearnerreglistComponent;
  let fixture: ComponentFixture<LearnerreglistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LearnerreglistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LearnerreglistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
