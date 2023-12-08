import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChangepasswordbackendComponent } from './changepasswordbackend.component';

describe('ChangepasswordbackendComponent', () => {
  let component: ChangepasswordbackendComponent;
  let fixture: ComponentFixture<ChangepasswordbackendComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChangepasswordbackendComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChangepasswordbackendComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
