import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ActivityfilterComponent } from './activityfilter.component';

describe('ActivityfilterComponent', () => {
  let component: ActivityfilterComponent;
  let fixture: ComponentFixture<ActivityfilterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ActivityfilterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ActivityfilterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
