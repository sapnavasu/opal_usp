import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewvalidationComponent } from './viewvalidation.component';

describe('ViewvalidationComponent', () => {
  let component: ViewvalidationComponent;
  let fixture: ComponentFixture<ViewvalidationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewvalidationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewvalidationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
