import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrainingroyaltyComponent } from './trainingroyalty.component';

describe('TrainingroyaltyComponent', () => {
  let component: TrainingroyaltyComponent;
  let fixture: ComponentFixture<TrainingroyaltyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrainingroyaltyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrainingroyaltyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
