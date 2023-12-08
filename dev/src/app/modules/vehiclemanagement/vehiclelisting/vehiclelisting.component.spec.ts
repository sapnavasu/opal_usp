import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VehiclelistingComponent } from './vehiclelisting.component';

describe('VehiclelistingComponent', () => {
  let component: VehiclelistingComponent;
  let fixture: ComponentFixture<VehiclelistingComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VehiclelistingComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VehiclelistingComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
