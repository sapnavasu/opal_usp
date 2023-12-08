import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CommoncommentsComponent } from './commoncomments.component';

describe('CommoncommentsComponent', () => {
  let component: CommoncommentsComponent;
  let fixture: ComponentFixture<CommoncommentsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CommoncommentsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CommoncommentsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
