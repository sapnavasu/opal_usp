import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RoyaltyfeeComponent } from './royaltyfee.component';

describe('RoyaltyfeeComponent', () => {
  let component: RoyaltyfeeComponent;
  let fixture: ComponentFixture<RoyaltyfeeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RoyaltyfeeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RoyaltyfeeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
