import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DepartmentfilterComponent } from './departmentfilter.component';

describe('DepartmentfilterComponent', () => {
  let component: DepartmentfilterComponent;
  let fixture: ComponentFixture<DepartmentfilterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DepartmentfilterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DepartmentfilterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
