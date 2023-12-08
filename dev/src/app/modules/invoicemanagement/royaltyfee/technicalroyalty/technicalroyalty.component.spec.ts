import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TechnicalroyaltyComponent } from './technicalroyalty.component';

describe('TechnicalroyaltyComponent', () => {
  let component: TechnicalroyaltyComponent;
  let fixture: ComponentFixture<TechnicalroyaltyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TechnicalroyaltyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TechnicalroyaltyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
