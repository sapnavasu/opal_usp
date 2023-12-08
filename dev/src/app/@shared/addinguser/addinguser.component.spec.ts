import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddinguserComponent } from './addinguser.component';

describe('AddinguserComponent', () => {
  let component: AddinguserComponent;
  let fixture: ComponentFixture<AddinguserComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddinguserComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddinguserComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
