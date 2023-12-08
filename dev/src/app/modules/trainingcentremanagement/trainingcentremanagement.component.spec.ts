import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrainingcentremanagementComponent } from './trainingcentremanagement.component';

describe('TrainingcentremanagementComponent', () => {
  let component: TrainingcentremanagementComponent;
  let fixture: ComponentFixture<TrainingcentremanagementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrainingcentremanagementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrainingcentremanagementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
