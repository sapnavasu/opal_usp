import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InviteexpiredComponent } from './inviteexpired.component';

describe('InviteexpiredComponent', () => {
  let component: InviteexpiredComponent;
  let fixture: ComponentFixture<InviteexpiredComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InviteexpiredComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InviteexpiredComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
