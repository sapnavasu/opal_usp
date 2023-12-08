import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrainingoperatorComponent } from './trainingoperator.component';

describe('TrainingoperatorComponent', () => {
  let component: TrainingoperatorComponent;
  let fixture: ComponentFixture<TrainingoperatorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrainingoperatorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrainingoperatorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
