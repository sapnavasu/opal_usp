import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StaffviewtechnicalComponent } from './staffviewtechnical.component';

describe('StaffviewtechnicalComponent', () => {
  let component: StaffviewtechnicalComponent;
  let fixture: ComponentFixture<StaffviewtechnicalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StaffviewtechnicalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StaffviewtechnicalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
