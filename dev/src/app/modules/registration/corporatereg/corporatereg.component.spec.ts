import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CorporateregComponent } from './corporatereg.component';

describe('CorporateregComponent', () => {
  let component: CorporateregComponent;
  let fixture: ComponentFixture<CorporateregComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CorporateregComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CorporateregComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
