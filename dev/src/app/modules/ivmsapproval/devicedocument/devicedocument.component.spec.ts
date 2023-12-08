import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DevicedocumentComponent } from './devicedocument.component';

describe('DevicedocumentComponent', () => {
  let component: DevicedocumentComponent;
  let fixture: ComponentFixture<DevicedocumentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DevicedocumentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DevicedocumentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
