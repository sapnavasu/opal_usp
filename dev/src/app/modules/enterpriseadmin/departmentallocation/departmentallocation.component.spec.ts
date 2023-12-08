import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DepartmentallocationComponent } from './departmentallocation.component';

describe('DepartmentallocationComponent', () => {
  let component: DepartmentallocationComponent;
  let fixture: ComponentFixture<DepartmentallocationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DepartmentallocationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DepartmentallocationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
