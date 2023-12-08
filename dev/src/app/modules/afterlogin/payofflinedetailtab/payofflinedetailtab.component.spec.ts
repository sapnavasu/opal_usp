import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PayofflinedetailtabComponent } from './payofflinedetailtab.component';

describe('PayofflinedetailtabComponent', () => {
  let component: PayofflinedetailtabComponent;
  let fixture: ComponentFixture<PayofflinedetailtabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PayofflinedetailtabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PayofflinedetailtabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
