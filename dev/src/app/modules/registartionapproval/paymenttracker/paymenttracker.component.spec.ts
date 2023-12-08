import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PaymenttrackerComponent } from './paymenttracker.component';

describe('PaymenttrackerComponent', () => {
  let component: PaymenttrackerComponent;
  let fixture: ComponentFixture<PaymenttrackerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PaymenttrackerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PaymenttrackerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
