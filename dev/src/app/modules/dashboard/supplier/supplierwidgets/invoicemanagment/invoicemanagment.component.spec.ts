import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InvoicemanagmentComponent } from './invoicemanagment.component';

describe('InvoicemanagmentComponent', () => {
  let component: InvoicemanagmentComponent;
  let fixture: ComponentFixture<InvoicemanagmentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InvoicemanagmentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InvoicemanagmentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
