import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrainingcertifyComponent } from './trainingcertify.component';

describe('TrainingcertifyComponent', () => {
  let component: TrainingcertifyComponent;
  let fixture: ComponentFixture<TrainingcertifyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrainingcertifyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrainingcertifyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
