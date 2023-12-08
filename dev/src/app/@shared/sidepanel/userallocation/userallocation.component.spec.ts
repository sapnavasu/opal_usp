import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UserallocationComponent } from './userallocation.component';

describe('UserallocationComponent', () => {
  let component: UserallocationComponent;
  let fixture: ComponentFixture<UserallocationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UserallocationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UserallocationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
