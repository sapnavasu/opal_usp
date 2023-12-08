import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TbranchofficecertificateComponent } from './tbranchofficecertificate.component';

describe('TbranchofficecertificateComponent', () => {
  let component: TbranchofficecertificateComponent;
  let fixture: ComponentFixture<TbranchofficecertificateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TbranchofficecertificateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TbranchofficecertificateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
