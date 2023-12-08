import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewpermissionsidenavComponent } from './viewpermissionsidenav.component';

describe('ViewpermissionsidenavComponent', () => {
  let component: ViewpermissionsidenavComponent;
  let fixture: ComponentFixture<ViewpermissionsidenavComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewpermissionsidenavComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewpermissionsidenavComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
