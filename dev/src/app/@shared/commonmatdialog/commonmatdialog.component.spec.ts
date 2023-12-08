import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CommonmatdialogComponent } from './commonmatdialog.component';

describe('CommonmatdialogComponent', () => {
  let component: CommonmatdialogComponent;
  let fixture: ComponentFixture<CommonmatdialogComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CommonmatdialogComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CommonmatdialogComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
