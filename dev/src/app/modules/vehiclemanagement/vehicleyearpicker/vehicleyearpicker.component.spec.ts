import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VehicleyearpickerComponent } from './vehicleyearpicker.component';

describe('VehicleyearpickerComponent', () => {
  let component: VehicleyearpickerComponent;
  let fixture: ComponentFixture<VehicleyearpickerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VehicleyearpickerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VehicleyearpickerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
