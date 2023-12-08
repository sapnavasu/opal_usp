import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PaymentprofileComponent } from './paymentprofile.component';

describe('PaymentprofileComponent', () => {
  let component: PaymentprofileComponent;
  let fixture: ComponentFixture<PaymentprofileComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PaymentprofileComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PaymentprofileComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
