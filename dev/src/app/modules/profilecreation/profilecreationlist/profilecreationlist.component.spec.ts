import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProfilecreationlistComponent } from './profilecreationlist.component';

describe('ProfilecreationlistComponent', () => {
  let component: ProfilecreationlistComponent;
  let fixture: ComponentFixture<ProfilecreationlistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProfilecreationlistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProfilecreationlistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
