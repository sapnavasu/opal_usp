import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RegisteredstakeholderlistComponent } from './registeredstakeholderlist.component';

describe('RegisteredstakeholderlistComponent', () => {
  let component: RegisteredstakeholderlistComponent;
  let fixture: ComponentFixture<RegisteredstakeholderlistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegisteredstakeholderlistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RegisteredstakeholderlistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
