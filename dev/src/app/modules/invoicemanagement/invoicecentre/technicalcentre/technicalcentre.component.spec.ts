import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TechnicalcentreComponent } from './technicalcentre.component';

describe('TechnicalcentreComponent', () => {
  let component: TechnicalcentreComponent;
  let fixture: ComponentFixture<TechnicalcentreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TechnicalcentreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TechnicalcentreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
