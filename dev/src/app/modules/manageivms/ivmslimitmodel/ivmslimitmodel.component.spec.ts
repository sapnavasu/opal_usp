import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmslimitmodelComponent } from './ivmslimitmodel.component';

describe('IvmslimitmodelComponent', () => {
  let component: IvmslimitmodelComponent;
  let fixture: ComponentFixture<IvmslimitmodelComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmslimitmodelComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmslimitmodelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
