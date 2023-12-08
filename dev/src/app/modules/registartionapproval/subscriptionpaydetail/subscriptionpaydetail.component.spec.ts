import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SubscriptionpaydetailComponent } from './subscriptionpaydetail.component';

describe('SubscriptionpaydetailComponent', () => {
  let component: SubscriptionpaydetailComponent;
  let fixture: ComponentFixture<SubscriptionpaydetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SubscriptionpaydetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SubscriptionpaydetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
