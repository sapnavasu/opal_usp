import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ReceiptlistviewComponent } from './receiptlistview.component';

describe('ReceiptlistviewComponent', () => {
  let component: ReceiptlistviewComponent;
  let fixture: ComponentFixture<ReceiptlistviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ReceiptlistviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ReceiptlistviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
