import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MainofficecertificateComponent } from './mainofficecertificate.component';

describe('MainofficecertificateComponent', () => {
  let component: MainofficecertificateComponent;
  let fixture: ComponentFixture<MainofficecertificateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MainofficecertificateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MainofficecertificateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
