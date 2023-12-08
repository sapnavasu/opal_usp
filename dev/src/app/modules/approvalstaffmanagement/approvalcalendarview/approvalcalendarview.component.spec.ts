import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ApprovalcalendarviewComponent } from './approvalcalendarview.component';

describe('ApprovalcalendarviewComponent', () => {
  let component: ApprovalcalendarviewComponent;
  let fixture: ComponentFixture<ApprovalcalendarviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ApprovalcalendarviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ApprovalcalendarviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
