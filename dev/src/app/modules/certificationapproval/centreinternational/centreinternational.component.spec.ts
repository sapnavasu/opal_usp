import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CentreinternationalComponent } from './centreinternational.component';

describe('CentreinternationalComponent', () => {
  let component: CentreinternationalComponent;
  let fixture: ComponentFixture<CentreinternationalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CentreinternationalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CentreinternationalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
