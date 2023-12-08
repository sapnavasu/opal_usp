import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InspectiondetialsComponent } from './inspectiondetials.component';

describe('InspectiondetialsComponent', () => {
  let component: InspectiondetialsComponent;
  let fixture: ComponentFixture<InspectiondetialsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InspectiondetialsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InspectiondetialsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
