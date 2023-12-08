import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SecuritydetailComponent } from './securitydetail.component';

describe('SecuritydetailComponent', () => {
  let component: SecuritydetailComponent;
  let fixture: ComponentFixture<SecuritydetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SecuritydetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SecuritydetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
