import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BusinessunitsComponent } from './businessunits.component';

describe('BusinessunitsComponent', () => {
  let component: BusinessunitsComponent;
  let fixture: ComponentFixture<BusinessunitsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BusinessunitsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BusinessunitsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
