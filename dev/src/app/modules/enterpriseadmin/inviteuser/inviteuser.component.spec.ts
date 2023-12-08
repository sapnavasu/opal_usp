import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InviteuserComponent } from './inviteuser.component';

describe('InviteuserComponent', () => {
  let component: InviteuserComponent;
  let fixture: ComponentFixture<InviteuserComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InviteuserComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InviteuserComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
