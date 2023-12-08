import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RenewalhistorylistviewComponent } from './renewalhistorylistview.component';

describe('RenewalhistorylistviewComponent', () => {
  let component: RenewalhistorylistviewComponent;
  let fixture: ComponentFixture<RenewalhistorylistviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RenewalhistorylistviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RenewalhistorylistviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
