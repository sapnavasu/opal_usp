import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CentrecompanydtlComponent } from './centrecompanydtl.component';

describe('CentrecompanydtlComponent', () => {
  let component: CentrecompanydtlComponent;
  let fixture: ComponentFixture<CentrecompanydtlComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CentrecompanydtlComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CentrecompanydtlComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
