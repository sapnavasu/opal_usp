import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChangeanotherComponent } from './changeanother.component';

describe('ChangeanotherComponent', () => {
  let component: ChangeanotherComponent;
  let fixture: ComponentFixture<ChangeanotherComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChangeanotherComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChangeanotherComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
