import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ReassignHistoryComponent } from './reassign-history.component';

describe('ReassignHistoryComponent', () => {
  let component: ReassignHistoryComponent;
  let fixture: ComponentFixture<ReassignHistoryComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ReassignHistoryComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ReassignHistoryComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
