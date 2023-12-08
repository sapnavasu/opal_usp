import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewandvalidateComponent } from './viewandvalidate.component';

describe('ViewandvalidateComponent', () => {
  let component: ViewandvalidateComponent;
  let fixture: ComponentFixture<ViewandvalidateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewandvalidateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewandvalidateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
