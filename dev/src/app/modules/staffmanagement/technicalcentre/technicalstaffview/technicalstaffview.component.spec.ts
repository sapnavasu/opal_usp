import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TechnicalstaffviewComponent } from './technicalstaffview.component';

describe('TechnicalstaffviewComponent', () => {
  let component: TechnicalstaffviewComponent;
  let fixture: ComponentFixture<TechnicalstaffviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TechnicalstaffviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TechnicalstaffviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
