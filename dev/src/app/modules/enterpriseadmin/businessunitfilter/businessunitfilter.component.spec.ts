import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BusinessunitfilterComponent } from './businessunitfilter.component';

describe('BusinessunitfilterComponent', () => {
  let component: BusinessunitfilterComponent;
  let fixture: ComponentFixture<BusinessunitfilterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BusinessunitfilterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BusinessunitfilterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
