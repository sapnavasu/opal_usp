import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CreatebasemoduleComponent } from './createbasemodule.component';

describe('CreatebasemoduleComponent', () => {
  let component: CreatebasemoduleComponent;
  let fixture: ComponentFixture<CreatebasemoduleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CreatebasemoduleComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CreatebasemoduleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
