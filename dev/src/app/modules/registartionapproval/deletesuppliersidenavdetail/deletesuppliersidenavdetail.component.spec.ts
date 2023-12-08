import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DeletesuppliersidenavdetailComponent } from './deletesuppliersidenavdetail.component';

describe('DeletesuppliersidenavdetailComponent', () => {
  let component: DeletesuppliersidenavdetailComponent;
  let fixture: ComponentFixture<DeletesuppliersidenavdetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DeletesuppliersidenavdetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DeletesuppliersidenavdetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
