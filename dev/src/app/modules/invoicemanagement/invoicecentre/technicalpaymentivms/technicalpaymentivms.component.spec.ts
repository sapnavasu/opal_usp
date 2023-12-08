import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TechnicalpaymentivmsComponent } from './technicalpaymentivms.component';

describe('TechnicalpaymentivmsComponent', () => {
  let component: TechnicalpaymentivmsComponent;
  let fixture: ComponentFixture<TechnicalpaymentivmsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TechnicalpaymentivmsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TechnicalpaymentivmsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
