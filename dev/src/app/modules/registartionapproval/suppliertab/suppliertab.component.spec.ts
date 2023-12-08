import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SuppliertabComponent } from './suppliertab.component';

describe('SuppliertabComponent', () => {
  let component: SuppliertabComponent;
  let fixture: ComponentFixture<SuppliertabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SuppliertabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SuppliertabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
