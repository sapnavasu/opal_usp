import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProfilelistviewComponent } from './profilelistview.component';

describe('ProfilelistviewComponent', () => {
  let component: ProfilelistviewComponent;
  let fixture: ComponentFixture<ProfilelistviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProfilelistviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProfilelistviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
