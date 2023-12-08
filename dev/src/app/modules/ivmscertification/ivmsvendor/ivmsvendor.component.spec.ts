import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsvendorComponent } from './ivmsvendor.component';

describe('IvmsvendorComponent', () => {
  let component: IvmsvendorComponent;
  let fixture: ComponentFixture<IvmsvendorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsvendorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsvendorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
