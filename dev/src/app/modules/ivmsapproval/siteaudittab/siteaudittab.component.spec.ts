import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SiteaudittabComponent } from './siteaudittab.component';

describe('SiteaudittabComponent', () => {
  let component: SiteaudittabComponent;
  let fixture: ComponentFixture<SiteaudittabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SiteaudittabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SiteaudittabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
