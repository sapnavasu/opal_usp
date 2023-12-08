import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewrascentreComponent } from './viewrascentre.component';

describe('ViewrascentreComponent', () => {
  let component: ViewrascentreComponent;
  let fixture: ComponentFixture<ViewrascentreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewrascentreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewrascentreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
