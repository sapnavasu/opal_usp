import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RoyaltypaymentComponent } from './royaltypayment.component';

describe('RoyaltypaymentComponent', () => {
  let component: RoyaltypaymentComponent;
  let fixture: ComponentFixture<RoyaltypaymentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RoyaltypaymentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RoyaltypaymentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
