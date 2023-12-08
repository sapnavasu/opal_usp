import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VehicleinfoboxComponent } from './vehicleinfobox.component';

describe('VehicleinfoboxComponent', () => {
  let component: VehicleinfoboxComponent;
  let fixture: ComponentFixture<VehicleinfoboxComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VehicleinfoboxComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VehicleinfoboxComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
