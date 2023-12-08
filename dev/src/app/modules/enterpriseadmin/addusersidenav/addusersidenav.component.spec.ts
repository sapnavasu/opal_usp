import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddusersidenavComponent } from './addusersidenav.component';

describe('AddusersidenavComponent', () => {
  let component: AddusersidenavComponent;
  let fixture: ComponentFixture<AddusersidenavComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddusersidenavComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddusersidenavComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
