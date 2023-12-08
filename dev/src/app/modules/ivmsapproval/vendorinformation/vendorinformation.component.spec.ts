import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VendorinformationComponent } from './vendorinformation.component';

describe('VendorinformationComponent', () => {
  let component: VendorinformationComponent;
  let fixture: ComponentFixture<VendorinformationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VendorinformationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VendorinformationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
