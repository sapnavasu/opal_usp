import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VehicleregisterComponent } from './vehicleregister.component';

describe('VehicleregisterComponent', () => {
  let component: VehicleregisterComponent;
  let fixture: ComponentFixture<VehicleregisterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VehicleregisterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VehicleregisterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
