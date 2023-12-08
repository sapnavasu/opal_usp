import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EmailpreferenceslistComponent } from './emailpreferenceslist.component';

describe('EmailpreferenceslistComponent', () => {
  let component: EmailpreferenceslistComponent;
  let fixture: ComponentFixture<EmailpreferenceslistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EmailpreferenceslistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EmailpreferenceslistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
