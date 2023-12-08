import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TemporaryloginsidenavdetailComponent } from './temporaryloginsidenavdetail.component';

describe('TemporaryloginsidenavdetailComponent', () => {
  let component: TemporaryloginsidenavdetailComponent;
  let fixture: ComponentFixture<TemporaryloginsidenavdetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TemporaryloginsidenavdetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TemporaryloginsidenavdetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
