import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VehicleimportComponent } from './vehicleimport.component';

describe('VehicleregisterComponent', () => {
  let component: VehicleimportComponent;
  let fixture: ComponentFixture<VehicleimportComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VehicleimportComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VehicleimportComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
