import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChangestaffComponent } from './changestaff.component';

describe('ChangestaffComponent', () => {
  let component: ChangestaffComponent;
  let fixture: ComponentFixture<ChangestaffComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChangestaffComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChangestaffComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
