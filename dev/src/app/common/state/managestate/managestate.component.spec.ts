import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ManagestateComponent } from './managestate.component';

describe('ManagestateComponent', () => {
  let component: ManagestateComponent;
  let fixture: ComponentFixture<ManagestateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ManagestateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ManagestateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
