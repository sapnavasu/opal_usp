import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LearnercardregComponent } from './learnercardreg.component';

describe('LearnercardregComponent', () => {
  let component: LearnercardregComponent;
  let fixture: ComponentFixture<LearnercardregComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LearnercardregComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LearnercardregComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
