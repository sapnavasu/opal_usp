import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StaffformComponent } from './staffform.component';

describe('StaffformComponent', () => {
  let component: StaffformComponent;
  let fixture: ComponentFixture<StaffformComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StaffformComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StaffformComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
