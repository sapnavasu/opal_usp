import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MaintenanceconfComponent } from './maintenanceconf.component';

describe('MaintenanceconfComponent', () => {
  let component: MaintenanceconfComponent;
  let fixture: ComponentFixture<MaintenanceconfComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MaintenanceconfComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MaintenanceconfComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
