import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MaincentreComponent } from './maincentre.component';

describe('MaincentreComponent', () => {
  let component: MaincentreComponent;
  let fixture: ComponentFixture<MaincentreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MaincentreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MaincentreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
