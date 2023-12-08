import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ManagebasemoduleComponent } from './managebasemodule.component';

describe('ManagebasemoduleComponent', () => {
  let component: ManagebasemoduleComponent;
  let fixture: ComponentFixture<ManagebasemoduleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ManagebasemoduleComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ManagebasemoduleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
