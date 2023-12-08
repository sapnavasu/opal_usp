import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CentreauditComponent } from './centreaudit.component';

describe('CentreauditComponent', () => {
  let component: CentreauditComponent;
  let fixture: ComponentFixture<CentreauditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CentreauditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CentreauditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
