import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OperatorlistComponent } from './operatorlist.component';

describe('OperatorlistComponent', () => {
  let component: OperatorlistComponent;
  let fixture: ComponentFixture<OperatorlistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OperatorlistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OperatorlistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
