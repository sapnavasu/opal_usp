import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InspectioncategoriesComponent } from './inspectioncategories.component';

describe('InspectioncategoriesComponent', () => {
  let component: InspectioncategoriesComponent;
  let fixture: ComponentFixture<InspectioncategoriesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InspectioncategoriesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InspectioncategoriesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
