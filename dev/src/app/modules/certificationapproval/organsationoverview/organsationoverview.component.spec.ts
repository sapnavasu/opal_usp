import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OrgansationoverviewComponent } from './organsationoverview.component';

describe('OrgansationoverviewComponent', () => {
  let component: OrgansationoverviewComponent;
  let fixture: ComponentFixture<OrgansationoverviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OrgansationoverviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OrgansationoverviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
