import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CompanyinfoivmsComponent } from './companyinfoivms.component';

describe('CompanyinfoivmsComponent', () => {
  let component: CompanyinfoivmsComponent;
  let fixture: ComponentFixture<CompanyinfoivmsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CompanyinfoivmsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CompanyinfoivmsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
