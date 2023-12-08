import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ApprovechangeComponent } from './approvechange.component';

describe('ApprovechangeComponent', () => {
  let component: ApprovechangeComponent;
  let fixture: ComponentFixture<ApprovechangeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ApprovechangeComponent ]
    })
    .compileComponents();   
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ApprovechangeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
