import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UsermoduleallocationComponent } from './usermoduleallocation.component';

describe('UsermoduleallocationComponent', () => {
  let component: UsermoduleallocationComponent;
  let fixture: ComponentFixture<UsermoduleallocationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UsermoduleallocationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UsermoduleallocationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });
  

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

