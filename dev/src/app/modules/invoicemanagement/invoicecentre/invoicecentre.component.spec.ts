import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InvoicecentreComponent } from './invoicecentre.component';

describe('InvoicecentreComponent', () => {
  let component: InvoicecentreComponent;
  let fixture: ComponentFixture<InvoicecentreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InvoicecentreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InvoicecentreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
