import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CreatestkholderaccessComponent } from './createstkholderaccess.component';

describe('CreatestkholderaccessComponent', () => {
  let component: CreatestkholderaccessComponent;
  let fixture: ComponentFixture<CreatestkholderaccessComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CreatestkholderaccessComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CreatestkholderaccessComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
