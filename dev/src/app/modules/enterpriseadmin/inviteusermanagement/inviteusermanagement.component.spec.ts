import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InviteusermanagementComponent } from './inviteusermanagement.component';

describe('InviteusermanagementComponent', () => {
  let component: InviteusermanagementComponent;
  let fixture: ComponentFixture<InviteusermanagementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InviteusermanagementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InviteusermanagementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
