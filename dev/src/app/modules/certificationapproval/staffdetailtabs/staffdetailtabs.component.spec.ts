import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StaffdetailtabsComponent } from './staffdetailtabs.component';

describe('StaffdetailtabsComponent', () => {
  let component: StaffdetailtabsComponent;
  let fixture: ComponentFixture<StaffdetailtabsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StaffdetailtabsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StaffdetailtabsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
