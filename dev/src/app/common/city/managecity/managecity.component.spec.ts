import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ManagecityComponent } from './managecity.component';

describe('ManagecityComponent', () => {
  let component: ManagecityComponent;
  let fixture: ComponentFixture<ManagecityComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ManagecityComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ManagecityComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
