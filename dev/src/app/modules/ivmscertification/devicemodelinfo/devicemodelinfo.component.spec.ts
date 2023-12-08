import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DevicemodelinfoComponent } from './devicemodelinfo.component';

describe('DevicemodelinfoComponent', () => {
  let component: DevicemodelinfoComponent;
  let fixture: ComponentFixture<DevicemodelinfoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DevicemodelinfoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DevicemodelinfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
