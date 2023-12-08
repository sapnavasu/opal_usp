import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PayonlinedetailtabComponent } from './payonlinedetailtab.component';

describe('PayonlinedetailtabComponent', () => {
  let component: PayonlinedetailtabComponent;
  let fixture: ComponentFixture<PayonlinedetailtabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PayonlinedetailtabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PayonlinedetailtabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
