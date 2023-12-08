import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AdddepartmentnavComponent } from './adddepartmentnav.component';

describe('AdddepartmentnavComponent', () => {
  let component: AdddepartmentnavComponent;
  let fixture: ComponentFixture<AdddepartmentnavComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AdddepartmentnavComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AdddepartmentnavComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
