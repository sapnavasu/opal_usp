import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CentreoperatorcontactsComponent } from './centreoperatorcontacts.component';

describe('CentreoperatorcontactsComponent', () => {
  let component: CentreoperatorcontactsComponent;
  let fixture: ComponentFixture<CentreoperatorcontactsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CentreoperatorcontactsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CentreoperatorcontactsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
