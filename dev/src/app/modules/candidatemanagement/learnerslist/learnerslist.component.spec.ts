import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LearnerslistComponent } from './learnerslist.component';

describe('LearnerslistComponent', () => {
  let component: LearnerslistComponent;
  let fixture: ComponentFixture<LearnerslistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LearnerslistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LearnerslistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
