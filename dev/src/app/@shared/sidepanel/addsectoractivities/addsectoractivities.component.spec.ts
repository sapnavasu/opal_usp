import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddsectoractivitiesComponent } from './addsectoractivities.component';

describe('AddsectoractivitiesComponent', () => {
  let component: AddsectoractivitiesComponent;
  let fixture: ComponentFixture<AddsectoractivitiesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddsectoractivitiesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddsectoractivitiesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
