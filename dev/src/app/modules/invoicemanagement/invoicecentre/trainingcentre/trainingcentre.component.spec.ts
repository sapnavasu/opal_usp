import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrainingcentreComponent } from './trainingcentre.component';

describe('TrainingcentreComponent', () => {
  let component: TrainingcentreComponent;
  let fixture: ComponentFixture<TrainingcentreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrainingcentreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrainingcentreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
