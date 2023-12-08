import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewmaincentreComponent } from './viewmaincentre.component';

describe('ViewmaincentreComponent', () => {
  let component: ViewmaincentreComponent;
  let fixture: ComponentFixture<ViewmaincentreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewmaincentreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewmaincentreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
