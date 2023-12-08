import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RoyaltytechpayComponent } from './royaltytechpay.component';

describe('RoyaltytechpayComponent', () => {
  let component: RoyaltytechpayComponent;
  let fixture: ComponentFixture<RoyaltytechpayComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RoyaltytechpayComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RoyaltytechpayComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
