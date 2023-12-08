import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistrationfooterComponent } from './registrationfooter.component';

describe('RegistrationfooterComponent', () => {
  let component: RegistrationfooterComponent;
  let fixture: ComponentFixture<RegistrationfooterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegistrationfooterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RegistrationfooterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
