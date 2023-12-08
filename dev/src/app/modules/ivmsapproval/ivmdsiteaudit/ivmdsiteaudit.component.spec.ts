import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmdsiteauditComponent } from './ivmdsiteaudit.component';

describe('IvmdsiteauditComponent', () => {
  let component: IvmdsiteauditComponent;
  let fixture: ComponentFixture<IvmdsiteauditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmdsiteauditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmdsiteauditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
