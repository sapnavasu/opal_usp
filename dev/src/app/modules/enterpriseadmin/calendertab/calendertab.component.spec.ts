import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CalendertabComponent } from './calendertab.component';

describe('CalendertabComponent', () => {
  let component: CalendertabComponent;
  let fixture: ComponentFixture<CalendertabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CalendertabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CalendertabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
