import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StaffviewtrainingComponent } from './staffviewtraining.component';

describe('StaffviewtrainingComponent', () => {
  let component: StaffviewtrainingComponent;
  let fixture: ComponentFixture<StaffviewtrainingComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StaffviewtrainingComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StaffviewtrainingComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
