import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CentreinstituteinfoComponent } from './centreinstituteinfo.component';

describe('CentreinstituteinfoComponent', () => {
  let component: CentreinstituteinfoComponent;
  let fixture: ComponentFixture<CentreinstituteinfoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CentreinstituteinfoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CentreinstituteinfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
