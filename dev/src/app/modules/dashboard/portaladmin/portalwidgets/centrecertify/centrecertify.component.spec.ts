import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CentrecertifyComponent } from './centrecertify.component';

describe('CentrecertifyComponent', () => {
  let component: CentrecertifyComponent;
  let fixture: ComponentFixture<CentrecertifyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CentrecertifyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CentrecertifyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
