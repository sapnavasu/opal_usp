import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SchedulesiteComponent } from './schedulesite.component';

describe('SchedulesiteComponent', () => {
  let component: SchedulesiteComponent;
  let fixture: ComponentFixture<SchedulesiteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SchedulesiteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SchedulesiteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
