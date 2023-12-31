import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FormbuilderComponent } from "./FormbuilderComponent";

describe('FormbuilderComponent', () => {
  let component: FormbuilderComponent;
  let fixture: ComponentFixture<FormbuilderComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FormbuilderComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FormbuilderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
