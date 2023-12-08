import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewandapproveComponent } from './viewandapprove.component';

describe('ViewandapproveComponent', () => {
  let component: ViewandapproveComponent;
  let fixture: ComponentFixture<ViewandapproveComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewandapproveComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewandapproveComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
