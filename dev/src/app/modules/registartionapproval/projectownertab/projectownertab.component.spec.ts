import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProjectownertabComponent } from './projectownertab.component';

describe('ProjectownertabComponent', () => {
  let component: ProjectownertabComponent;
  let fixture: ComponentFixture<ProjectownertabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProjectownertabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProjectownertabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
