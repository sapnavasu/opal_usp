import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SitepracticalComponent } from './sitepractical.component';

describe('SitepracticalComponent', () => {
  let component: SitepracticalComponent;
  let fixture: ComponentFixture<SitepracticalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SitepracticalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SitepracticalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
