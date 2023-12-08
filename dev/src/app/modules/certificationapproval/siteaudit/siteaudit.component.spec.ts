import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SiteauditComponent } from './siteaudit.component';

describe('SiteauditComponent', () => {
  let component: SiteauditComponent;
  let fixture: ComponentFixture<SiteauditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SiteauditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SiteauditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
