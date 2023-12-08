import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InvestorcontentComponent } from './investorcontent.component';

describe('InvestorcontentComponent', () => {
  let component: InvestorcontentComponent;
  let fixture: ComponentFixture<InvestorcontentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InvestorcontentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InvestorcontentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
