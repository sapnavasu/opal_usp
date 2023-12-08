import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChangeassessorComponent } from './changeassessor.component';

describe('ChangeassessorComponent', () => {
  let component: ChangeassessorComponent;
  let fixture: ComponentFixture<ChangeassessorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChangeassessorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChangeassessorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
