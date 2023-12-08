import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InvoicecourseComponent } from './invoicecourse.component';

describe('InvoicecourseComponent', () => {
  let component: InvoicecourseComponent;
  let fixture: ComponentFixture<InvoicecourseComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InvoicecourseComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InvoicecourseComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
