import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddingdetailssidenavComponent } from './addingdetailssidenav.component';

describe('AddingdetailssidenavComponent', () => {
  let component: AddingdetailssidenavComponent;
  let fixture: ComponentFixture<AddingdetailssidenavComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddingdetailssidenavComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddingdetailssidenavComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
