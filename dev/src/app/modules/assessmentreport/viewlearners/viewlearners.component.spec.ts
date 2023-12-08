import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewlearnersComponent } from './viewlearners.component';

describe('ViewlearnersComponent', () => {
  let component: ViewlearnersComponent;
  let fixture: ComponentFixture<ViewlearnersComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewlearnersComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewlearnersComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
