import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RegistrationapprovalComponent } from './registrationapproval.component';

describe('RegistrationapprovalComponent', () => {
  let component: RegistrationapprovalComponent;
  let fixture: ComponentFixture<RegistrationapprovalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegistrationapprovalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RegistrationapprovalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
