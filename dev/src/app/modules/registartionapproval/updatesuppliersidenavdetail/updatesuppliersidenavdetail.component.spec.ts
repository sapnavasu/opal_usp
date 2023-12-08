import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdatesuppliersidenavdetailComponent } from './updatesuppliersidenavdetail.component';

describe('UpdatesuppliersidenavdetailComponent', () => {
  let component: UpdatesuppliersidenavdetailComponent;
  let fixture: ComponentFixture<UpdatesuppliersidenavdetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UpdatesuppliersidenavdetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UpdatesuppliersidenavdetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
