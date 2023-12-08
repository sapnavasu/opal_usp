import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistrationheaderComponent } from './registrationheader.component';

describe('RegistrationheaderComponent', () => {
  let component: RegistrationheaderComponent;
  let fixture: ComponentFixture<RegistrationheaderComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegistrationheaderComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RegistrationheaderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
