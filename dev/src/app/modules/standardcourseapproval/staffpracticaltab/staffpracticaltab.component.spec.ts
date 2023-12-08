import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StaffpracticaltabComponent } from './staffpracticaltab.component';

describe('StaffpracticaltabComponent', () => {
  let component: StaffpracticaltabComponent;
  let fixture: ComponentFixture<StaffpracticaltabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StaffpracticaltabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StaffpracticaltabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
