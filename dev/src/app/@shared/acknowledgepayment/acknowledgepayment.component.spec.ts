import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AcknowledgepaymentComponent } from './acknowledgepayment.component';

describe('AcknowledgepaymentComponent', () => {
  let component: AcknowledgepaymentComponent;
  let fixture: ComponentFixture<AcknowledgepaymentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AcknowledgepaymentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AcknowledgepaymentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
