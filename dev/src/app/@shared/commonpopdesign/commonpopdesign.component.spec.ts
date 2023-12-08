import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CommonpopdesignComponent } from './commonpopdesign.component';

describe('CommonpopdesignComponent', () => {
  let component: CommonpopdesignComponent;
  let fixture: ComponentFixture<CommonpopdesignComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CommonpopdesignComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CommonpopdesignComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
