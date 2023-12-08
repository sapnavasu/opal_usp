import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewcredentialsidenavdetailComponent } from './viewcredentialsidenavdetail.component';

describe('ViewcredentialsidenavdetailComponent', () => {
  let component: ViewcredentialsidenavdetailComponent;
  let fixture: ComponentFixture<ViewcredentialsidenavdetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewcredentialsidenavdetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewcredentialsidenavdetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
