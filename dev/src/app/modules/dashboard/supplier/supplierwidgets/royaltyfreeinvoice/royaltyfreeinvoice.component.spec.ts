import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RoyaltyfreeinvoiceComponent } from './royaltyfreeinvoice.component';

describe('RoyaltyfreeinvoiceComponent', () => {
  let component: RoyaltyfreeinvoiceComponent;
  let fixture: ComponentFixture<RoyaltyfreeinvoiceComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RoyaltyfreeinvoiceComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RoyaltyfreeinvoiceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
