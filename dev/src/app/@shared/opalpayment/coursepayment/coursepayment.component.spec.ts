import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CoursepaymentComponent } from './coursepayment.component';

describe('CoursepaymentComponent', () => {
  let component: CoursepaymentComponent;
  let fixture: ComponentFixture<CoursepaymentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CoursepaymentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CoursepaymentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
