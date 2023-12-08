import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OrganiserdetailtrackersidenavlistComponent } from './organiserdetailtrackersidenavlist.component';

describe('OrganiserdetailtrackersidenavlistComponent', () => {
  let component: OrganiserdetailtrackersidenavlistComponent;
  let fixture: ComponentFixture<OrganiserdetailtrackersidenavlistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OrganiserdetailtrackersidenavlistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OrganiserdetailtrackersidenavlistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
