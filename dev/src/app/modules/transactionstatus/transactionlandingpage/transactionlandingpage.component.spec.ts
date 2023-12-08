import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TransactionlandingpageComponent } from './transactionlandingpage.component';

describe('TransactionlandingpageComponent', () => {
  let component: TransactionlandingpageComponent;
  let fixture: ComponentFixture<TransactionlandingpageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TransactionlandingpageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TransactionlandingpageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
