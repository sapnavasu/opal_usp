import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OperatorformComponent } from './operatorform.component';

describe('OperatorformComponent', () => {
  let component: OperatorformComponent;
  let fixture: ComponentFixture<OperatorformComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OperatorformComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OperatorformComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
