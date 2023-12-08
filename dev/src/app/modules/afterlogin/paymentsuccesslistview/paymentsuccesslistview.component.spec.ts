import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PaymentsuccesslistviewComponent } from './paymentsuccesslistview.component';

describe('PaymentsuccesslistviewComponent', () => {
  let component: PaymentsuccesslistviewComponent;
  let fixture: ComponentFixture<PaymentsuccesslistviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PaymentsuccesslistviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PaymentsuccesslistviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
