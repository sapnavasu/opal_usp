import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CourseinformationComponent } from './courseinformation.component';

describe('CourseinformationComponent', () => {
  let component: CourseinformationComponent;
  let fixture: ComponentFixture<CourseinformationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CourseinformationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CourseinformationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
