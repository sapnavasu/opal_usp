import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewapprovalComponent } from './viewapproval.component';

describe('ViewapprovalComponent', () => {
  let component: ViewapprovalComponent;
  let fixture: ComponentFixture<ViewapprovalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewapprovalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewapprovalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
