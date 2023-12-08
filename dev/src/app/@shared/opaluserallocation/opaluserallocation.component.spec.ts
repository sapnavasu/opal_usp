import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OpaluserallocationComponent } from './opaluserallocation.component';

describe('OpaluserallocationComponent', () => {
  let component: OpaluserallocationComponent;
  let fixture: ComponentFixture<OpaluserallocationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OpaluserallocationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OpaluserallocationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
