import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StandardcoursesComponent } from './standardcourses.component';

describe('StandardcoursesComponent', () => {
  let component: StandardcoursesComponent;
  let fixture: ComponentFixture<StandardcoursesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StandardcoursesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StandardcoursesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
