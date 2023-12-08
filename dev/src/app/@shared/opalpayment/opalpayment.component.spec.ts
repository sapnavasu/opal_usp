import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OpalpaymentComponent } from './opalpayment.component';

describe('OpalpaymentComponent', () => {
  let component: OpalpaymentComponent;
  let fixture: ComponentFixture<OpalpaymentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OpalpaymentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OpalpaymentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
