import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProjectownercardComponent } from './projectownercard.component';

describe('ProjectownercardComponent', () => {
  let component: ProjectownercardComponent;
  let fixture: ComponentFixture<ProjectownercardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProjectownercardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProjectownercardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
