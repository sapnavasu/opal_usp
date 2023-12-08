import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InviteexternallistComponent } from './inviteexternallist.component';

describe('InviteexternallistComponent', () => {
  let component: InviteexternallistComponent;
  let fixture: ComponentFixture<InviteexternallistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InviteexternallistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InviteexternallistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
