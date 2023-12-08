import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PaymentcentreComponent } from './paymentcentre.component';

describe('PaymentcentreComponent', () => {
  let component: PaymentcentreComponent;
  let fixture: ComponentFixture<PaymentcentreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PaymentcentreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PaymentcentreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
