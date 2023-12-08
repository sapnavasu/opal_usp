import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SupplierapprovaltabComponent } from './supplierapprovaltab.component';

describe('SupplierapprovaltabComponent', () => {
  let component: SupplierapprovaltabComponent;
  let fixture: ComponentFixture<SupplierapprovaltabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SupplierapprovaltabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SupplierapprovaltabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
