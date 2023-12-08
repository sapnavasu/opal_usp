import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PortalinvoicemngmntComponent } from './portalinvoicemngmnt.component';

describe('PortalinvoicemngmntComponent', () => {
  let component: PortalinvoicemngmntComponent;
  let fixture: ComponentFixture<PortalinvoicemngmntComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PortalinvoicemngmntComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PortalinvoicemngmntComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
