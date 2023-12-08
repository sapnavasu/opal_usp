import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TechnicalviewivmsComponent } from './technicalviewivms.component';

describe('TechnicalviewivmsComponent', () => {
  let component: TechnicalviewivmsComponent;
  let fixture: ComponentFixture<TechnicalviewivmsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TechnicalviewivmsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TechnicalviewivmsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
