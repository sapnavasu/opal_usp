import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProjectownerregComponent } from './projectownerreg.component';

describe('ProjectownerregComponent', () => {
  let component: ProjectownerregComponent;
  let fixture: ComponentFixture<ProjectownerregComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProjectownerregComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProjectownerregComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
