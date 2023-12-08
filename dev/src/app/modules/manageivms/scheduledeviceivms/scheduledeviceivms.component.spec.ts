import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ScheduledeviceivmsComponent } from './scheduledeviceivms.component';

describe('ScheduledeviceivmsComponent', () => {
  let component: ScheduledeviceivmsComponent;
  let fixture: ComponentFixture<ScheduledeviceivmsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ScheduledeviceivmsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ScheduledeviceivmsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
