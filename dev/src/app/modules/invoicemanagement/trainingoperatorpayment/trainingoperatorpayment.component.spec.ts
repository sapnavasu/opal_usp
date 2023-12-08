import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrainingoperatorpaymentComponent } from './trainingoperatorpayment.component';

describe('TrainingoperatorpaymentComponent', () => {
  let component: TrainingoperatorpaymentComponent;
  let fixture: ComponentFixture<TrainingoperatorpaymentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrainingoperatorpaymentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrainingoperatorpaymentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
