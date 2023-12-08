import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StafcvComponent } from './stafcv.component';

describe('StafcvComponent', () => {
  let component: StafcvComponent;
  let fixture: ComponentFixture<StafcvComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StafcvComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StafcvComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
