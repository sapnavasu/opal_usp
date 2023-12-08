import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RepresentativeofficeComponent } from './representativeoffice.component';

describe('RepresentativeofficeComponent', () => {
  let component: RepresentativeofficeComponent;
  let fixture: ComponentFixture<RepresentativeofficeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RepresentativeofficeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RepresentativeofficeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
