import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CentrecertificationComponent } from './centrecertification.component';

describe('CentrecertificationComponent', () => {
  let component: CentrecertificationComponent;
  let fixture: ComponentFixture<CentrecertificationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CentrecertificationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CentrecertificationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
