import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OrganisationqaComponent } from './organisationqa.component';

describe('OrganisationqaComponent', () => {
  let component: OrganisationqaComponent;
  let fixture: ComponentFixture<OrganisationqaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OrganisationqaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OrganisationqaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
