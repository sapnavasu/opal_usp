import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StafftrainingComponent } from './stafftraining.component';

describe('StafftrainingComponent', () => {
  let component: StafftrainingComponent;
  let fixture: ComponentFixture<StafftrainingComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StafftrainingComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StafftrainingComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
