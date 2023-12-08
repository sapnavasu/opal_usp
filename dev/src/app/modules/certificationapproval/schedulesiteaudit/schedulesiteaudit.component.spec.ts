import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SchedulesiteauditComponent } from './schedulesiteaudit.component';

describe('SchedulesiteauditComponent', () => {
  let component: SchedulesiteauditComponent;
  let fixture: ComponentFixture<SchedulesiteauditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SchedulesiteauditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SchedulesiteauditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
