import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { YearlypickerComponent } from './yearlypicker.component';

describe('YearlypickerComponent', () => {
  let component: YearlypickerComponent;
  let fixture: ComponentFixture<YearlypickerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ YearlypickerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(YearlypickerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
