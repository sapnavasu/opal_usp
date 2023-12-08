import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CompanyivmsComponent } from './companyivms.component';

describe('CompanyivmsComponent', () => {
  let component: CompanyivmsComponent;
  let fixture: ComponentFixture<CompanyivmsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CompanyivmsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CompanyivmsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
