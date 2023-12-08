import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StaffapprovalComponent } from './staffapproval.component';

describe('StaffapprovalComponent', () => {
  let component: StaffapprovalComponent;
  let fixture: ComponentFixture<StaffapprovalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StaffapprovalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StaffapprovalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
