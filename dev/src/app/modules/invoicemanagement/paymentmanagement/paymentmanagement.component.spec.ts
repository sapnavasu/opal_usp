import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PaymentmanagementComponent } from './paymentmanagement.component';

describe('PaymentmanagementComponent', () => {
  let component: PaymentmanagementComponent;
  let fixture: ComponentFixture<PaymentmanagementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PaymentmanagementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PaymentmanagementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
