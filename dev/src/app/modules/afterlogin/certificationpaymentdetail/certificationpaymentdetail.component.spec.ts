import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CertificationpaymentdetailComponent } from './certificationpaymentdetail.component';

describe('CertificationpaymentdetailComponent', () => {
  let component: CertificationpaymentdetailComponent;
  let fixture: ComponentFixture<CertificationpaymentdetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CertificationpaymentdetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CertificationpaymentdetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
