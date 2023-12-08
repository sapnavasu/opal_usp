import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { NotestabComponent } from './notestab.component';

describe('NotestabComponent', () => {
  let component: NotestabComponent;
  let fixture: ComponentFixture<NotestabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NotestabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NotestabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
