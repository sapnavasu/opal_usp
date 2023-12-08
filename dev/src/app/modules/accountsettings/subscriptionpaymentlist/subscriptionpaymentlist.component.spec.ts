import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SubscriptionpaymentlistComponent } from './subscriptionpaymentlist.component';

describe('SubscriptionpaymentlistComponent', () => {
  let component: SubscriptionpaymentlistComponent;
  let fixture: ComponentFixture<SubscriptionpaymentlistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SubscriptionpaymentlistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SubscriptionpaymentlistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
