import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VehicleinspectionComponent } from './vehicleinspection.component';

describe('VehicleinspectionComponent', () => {
  let component: VehicleinspectionComponent;
  let fixture: ComponentFixture<VehicleinspectionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VehicleinspectionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VehicleinspectionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
