import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CoursetabdetailComponent } from './coursetabdetail.component';

describe('CoursetabdetailComponent', () => {
  let component: CoursetabdetailComponent;
  let fixture: ComponentFixture<CoursetabdetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CoursetabdetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CoursetabdetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
