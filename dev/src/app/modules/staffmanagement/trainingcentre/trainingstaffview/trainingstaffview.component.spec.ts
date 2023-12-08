import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrainingstaffviewComponent } from './trainingstaffview.component';

describe('TrainingstaffviewComponent', () => {
  let component: TrainingstaffviewComponent;
  let fixture: ComponentFixture<TrainingstaffviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrainingstaffviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrainingstaffviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
