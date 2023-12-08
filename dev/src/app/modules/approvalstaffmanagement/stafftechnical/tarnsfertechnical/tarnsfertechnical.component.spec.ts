import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TarnsfertechnicalComponent } from './tarnsfertechnical.component';

describe('TarnsfertechnicalComponent', () => {
  let component: TarnsfertechnicalComponent;
  let fixture: ComponentFixture<TarnsfertechnicalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TarnsfertechnicalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TarnsfertechnicalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
