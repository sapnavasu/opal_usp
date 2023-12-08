import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsdevicemodelComponent } from './ivmsdevicemodel.component';

describe('IvmsdevicemodelComponent', () => {
  let component: IvmsdevicemodelComponent;
  let fixture: ComponentFixture<IvmsdevicemodelComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsdevicemodelComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsdevicemodelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
