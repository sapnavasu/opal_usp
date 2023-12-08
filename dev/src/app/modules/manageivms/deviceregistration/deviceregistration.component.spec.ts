import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DeviceregistrationComponent } from './deviceregistration.component';

describe('DeviceregistrationComponent', () => {
  let component: DeviceregistrationComponent;
  let fixture: ComponentFixture<DeviceregistrationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DeviceregistrationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DeviceregistrationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
