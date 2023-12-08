import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StaffinfocardComponent } from './staffinfocard.component';

describe('StaffinfocardComponent', () => {
  let component: StaffinfocardComponent;
  let fixture: ComponentFixture<StaffinfocardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StaffinfocardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StaffinfocardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
