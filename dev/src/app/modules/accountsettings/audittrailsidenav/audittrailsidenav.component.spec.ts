import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AudittrailsidenavComponent } from './audittrailsidenav.component';

describe('AudittrailsidenavComponent', () => {
  let component: AudittrailsidenavComponent;
  let fixture: ComponentFixture<AudittrailsidenavComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AudittrailsidenavComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AudittrailsidenavComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
