import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BuyerregComponent } from './buyerreg.component';

describe('BuyerregComponent', () => {
  let component: BuyerregComponent;
  let fixture: ComponentFixture<BuyerregComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BuyerregComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BuyerregComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
