import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DropdownelementcardComponent } from './dropdownelementcard.component';

describe('DropdownelementcardComponent', () => {
  let component: DropdownelementcardComponent;
  let fixture: ComponentFixture<DropdownelementcardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DropdownelementcardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DropdownelementcardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
