import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PaymentproofComponent } from './paymentproof.component';

describe('PaymentproofComponent', () => {
  let component: PaymentproofComponent;
  let fixture: ComponentFixture<PaymentproofComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PaymentproofComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PaymentproofComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
