import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BranchofficecertificateComponent } from './branchofficecertificate.component';

describe('BranchofficecertificateComponent', () => {
  let component: BranchofficecertificateComponent;
  let fixture: ComponentFixture<BranchofficecertificateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BranchofficecertificateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BranchofficecertificateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
