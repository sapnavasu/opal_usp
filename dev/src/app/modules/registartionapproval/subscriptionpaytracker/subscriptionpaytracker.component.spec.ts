import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SubscriptionpaytrackerComponent } from './subscriptionpaytracker.component';

describe('SubscriptionpaytrackerComponent', () => {
  let component: SubscriptionpaytrackerComponent;
  let fixture: ComponentFixture<SubscriptionpaytrackerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SubscriptionpaytrackerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SubscriptionpaytrackerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
