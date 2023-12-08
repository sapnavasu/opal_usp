import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsoperatorComponent } from './ivmsoperator.component';

describe('IvmsoperatorComponent', () => {
  let component: IvmsoperatorComponent;
  let fixture: ComponentFixture<IvmsoperatorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsoperatorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsoperatorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
