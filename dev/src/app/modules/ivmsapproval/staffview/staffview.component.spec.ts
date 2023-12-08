import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StaffviewComponent } from './staffview.component';

describe('StaffviewComponent', () => {
  let component: StaffviewComponent;
  let fixture: ComponentFixture<StaffviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StaffviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StaffviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
