import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PayofflinesuccesslistviewComponent } from './payofflinesuccesslistview.component';

describe('PayofflinesuccesslistviewComponent', () => {
  let component: PayofflinesuccesslistviewComponent;
  let fixture: ComponentFixture<PayofflinesuccesslistviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PayofflinesuccesslistviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PayofflinesuccesslistviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
