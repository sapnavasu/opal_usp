import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PaymentmapuserComponent } from './paymentmapuser.component';

describe('PaymentmapuserComponent', () => {
  let component: PaymentmapuserComponent;
  let fixture: ComponentFixture<PaymentmapuserComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PaymentmapuserComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PaymentmapuserComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
