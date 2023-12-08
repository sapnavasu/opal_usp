import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LearnercardgridlistComponent } from './learnercardgridlist.component';

describe('LearnercardgridlistComponent', () => {
  let component: LearnercardgridlistComponent;
  let fixture: ComponentFixture<LearnercardgridlistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LearnercardgridlistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LearnercardgridlistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
