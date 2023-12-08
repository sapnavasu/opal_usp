import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BranchcentreComponent } from './branchcentre.component';

describe('BranchcentreComponent', () => {
  let component: BranchcentreComponent;
  let fixture: ComponentFixture<BranchcentreComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BranchcentreComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BranchcentreComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
