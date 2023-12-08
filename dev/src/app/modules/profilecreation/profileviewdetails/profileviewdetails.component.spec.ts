import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProfileviewdetailsComponent } from './profileviewdetails.component';

describe('ProfileviewdetailsComponent', () => {
  let component: ProfileviewdetailsComponent;
  let fixture: ComponentFixture<ProfileviewdetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProfileviewdetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProfileviewdetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
