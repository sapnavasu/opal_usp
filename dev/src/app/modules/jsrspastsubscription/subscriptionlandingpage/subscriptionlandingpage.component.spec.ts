import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SubscriptionlandingpageComponent } from './subscriptionlandingpage.component';

describe('SubscriptionlandingpageComponent', () => {
  let component: SubscriptionlandingpageComponent;
  let fixture: ComponentFixture<SubscriptionlandingpageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SubscriptionlandingpageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SubscriptionlandingpageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
