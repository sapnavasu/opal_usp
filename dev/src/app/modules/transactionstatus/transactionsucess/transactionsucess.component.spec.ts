import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TransactionsucessComponent } from './transactionsucess.component';

describe('TransactionsucessComponent', () => {
  let component: TransactionsucessComponent;
  let fixture: ComponentFixture<TransactionsucessComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TransactionsucessComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TransactionsucessComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
