import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TmainofficecertificateComponent } from './tmainofficecertificate.component';

describe('TmainofficecertificateComponent', () => {
  let component: TmainofficecertificateComponent;
  let fixture: ComponentFixture<TmainofficecertificateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TmainofficecertificateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TmainofficecertificateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
