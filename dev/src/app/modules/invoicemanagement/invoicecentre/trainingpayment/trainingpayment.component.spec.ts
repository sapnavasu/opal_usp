import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrainingpaymentComponent } from './trainingpayment.component';

describe('TrainingpaymentComponent', () => {
  let component: TrainingpaymentComponent;
  let fixture: ComponentFixture<TrainingpaymentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrainingpaymentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrainingpaymentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
