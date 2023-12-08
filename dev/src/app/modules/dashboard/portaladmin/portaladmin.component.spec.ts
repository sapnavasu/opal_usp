import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PortaladminComponent } from './portaladmin.component';

describe('PortaladminComponent', () => {
  let component: PortaladminComponent;
  let fixture: ComponentFixture<PortaladminComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PortaladminComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PortaladminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
