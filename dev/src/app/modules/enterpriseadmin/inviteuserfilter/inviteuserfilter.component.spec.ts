import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InviteuserfilterComponent } from './inviteuserfilter.component';

describe('InviteuserfilterComponent', () => {
  let component: InviteuserfilterComponent;
  let fixture: ComponentFixture<InviteuserfilterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InviteuserfilterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InviteuserfilterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
