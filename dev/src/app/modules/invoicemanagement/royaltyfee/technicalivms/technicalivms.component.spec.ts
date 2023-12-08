import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TechnicalivmsComponent } from './technicalivms.component';

describe('TechnicalivmsComponent', () => {
  let component: TechnicalivmsComponent;
  let fixture: ComponentFixture<TechnicalivmsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TechnicalivmsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TechnicalivmsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
