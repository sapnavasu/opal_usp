import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TransferstaffComponent } from './transferstaff.component';

describe('TransferstaffComponent', () => {
  let component: TransferstaffComponent;
  let fixture: ComponentFixture<TransferstaffComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TransferstaffComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TransferstaffComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
