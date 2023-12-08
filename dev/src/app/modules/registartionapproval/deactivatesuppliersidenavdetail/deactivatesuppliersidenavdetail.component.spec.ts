import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DeactivatesuppliersidenavdetailComponent } from './deactivatesuppliersidenavdetail.component';

describe('DeactivatesuppliersidenavdetailComponent', () => {
  let component: DeactivatesuppliersidenavdetailComponent;
  let fixture: ComponentFixture<DeactivatesuppliersidenavdetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DeactivatesuppliersidenavdetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DeactivatesuppliersidenavdetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
