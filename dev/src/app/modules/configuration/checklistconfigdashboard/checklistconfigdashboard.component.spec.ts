import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChecklistconfigdashboardComponent } from './checklistconfigdashboard.component';

describe('ChecklistconfigdashboardComponent', () => {
  let component: ChecklistconfigdashboardComponent;
  let fixture: ComponentFixture<ChecklistconfigdashboardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChecklistconfigdashboardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChecklistconfigdashboardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
