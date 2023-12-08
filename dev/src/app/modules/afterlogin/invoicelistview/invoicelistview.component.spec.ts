import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InvoicelistviewComponent } from './invoicelistview.component';

describe('InvoicelistviewComponent', () => {
  let component: InvoicelistviewComponent;
  let fixture: ComponentFixture<InvoicelistviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InvoicelistviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InvoicelistviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
