import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrackhistorylistviewComponent } from './trackhistorylistview.component';

describe('TrackhistorylistviewComponent', () => {
  let component: TrackhistorylistviewComponent;
  let fixture: ComponentFixture<TrackhistorylistviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrackhistorylistviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrackhistorylistviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
