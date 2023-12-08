import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ManagestkholderaccessComponent } from './managestkholderaccess.component';

describe('ManagestkholderaccessComponent', () => {
  let component: ManagestkholderaccessComponent;
  let fixture: ComponentFixture<ManagestkholderaccessComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ManagestkholderaccessComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ManagestkholderaccessComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
