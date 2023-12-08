import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TechnicalpaymentComponent } from './technicalpayment.component';

describe('TechnicalpaymentComponent', () => {
  let component: TechnicalpaymentComponent;
  let fixture: ComponentFixture<TechnicalpaymentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TechnicalpaymentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TechnicalpaymentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
