import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SupplierregComponent } from './supplierreg.component';

describe('SupplierregComponent', () => {
  let component: SupplierregComponent;
  let fixture: ComponentFixture<SupplierregComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SupplierregComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SupplierregComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
