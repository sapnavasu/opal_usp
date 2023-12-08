import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ThankyoucardComponent } from './thankyoucard.component';

describe('ThankyoucardComponent', () => {
  let component: ThankyoucardComponent;
  let fixture: ComponentFixture<ThankyoucardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ThankyoucardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ThankyoucardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
